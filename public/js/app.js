const SLIDE_WIDTH = 500;

(function (win) {
    function isAlbumPage() {
        return window.location.href.indexOf('album') > 0;
    }

    function isInterestinsgPage() {
        return window.location.href.indexOf('interestings') > 0;
    }

    function isContactPage() {
        return window.location.href.indexOf('contacts') > 0;
    }

    function isTestPage() {
        return window.location.href.indexOf('test') > 0;
    }

    function isStoryPage() {
        return window.location.href.indexOf('history') > 0;
    }

    function getConfig(configName) {
        return new Promise((resolve, reject) => $.getJSON(`public/configs/${configName}`, data => resolve(data)));
    }

    const albumImageTemplate = $('<div class="img-wrap"><img class="album-image"><span class="img-description"></span><div class="pop-up-description"></div></div>');
    const controlButtons = $('<div class="controll-buttons"><button class="prev"><</button><button class="next">></button></div>');

    function createImageElement(imgConfig, id) {
        const imgWrap = albumImageTemplate.clone();

        imgWrap.prepend(controlButtons.clone());

        const img = imgWrap.find('img');
        img.attr('src', imgConfig.image);
        img.data('id', id);

        const title = imgWrap.find('.img-description');
        title.text(imgConfig.title);

        const description = imgWrap.find('.pop-up-description');
        description.text(imgConfig.description);

        return imgWrap;
    }

    const imageSlide = $('<li><img></li>');

    function createSlide(imgConfig) {
        const slide = imageSlide.clone();
        slide.find('img').attr('src', imgConfig.image);

        return slide;
    }

    async function renderAlbumElements() {
        // const images = await getConfig('album.json');

        // const gallery = $('.gallery');
        const carousel = $('.image-full-view .carousel ul');
        const images = $('.album-image');

        // for (let i = 0; i < images.length; i += 1) {
        //     const imageElem = createImageElement(images[i], i);
        //     gallery.append(imageElem);
        //     const slide = createSlide(images[i]);
        //     carousel.append(slide);
        // }

        // gallery.find('.prev').click(function () {
        //     const self = $(this);
        //     const wrap = self.closest('.img-wrap');
        //     if (wrap.is(':first-child')) {
        //         return gallery.find('.img-wrap:last-child').after(wrap);
        //     }

        //     wrap.prev().before(wrap);
        // });

        // gallery.find('.next').click(function () {
        //     const self = $(this);
        //     const wrap = self.closest('.img-wrap');
        //     if (wrap.is(':last-child')) {
        //         return gallery.find('.img-wrap:first-child').before(wrap);
        //     }

        //     wrap.next().after(wrap);
        // });

        const width = images.length * SLIDE_WIDTH;
        carousel.css('width', `${width}px`);
    }

    function moveCarousel(carousel, id) {
        const left = -500 * id;
        carousel.css('left', left);
    }

    function makeGalleryClickable() {
        const overlay = $('.image-full-view');
        const carousel = overlay.find('ul');
        const images = $('.img-wrap');
        const imagesAmount = images.length - 1;
        const prevBtn = overlay.find('.toggle.prev');
        const nextBtn = overlay.find('.toggle.next');
        const currIdElem = overlay.find('.curr');
        const totalImagesElem = overlay.find('.total');
        const imageTitle = overlay.find('.image-title').find('p');

        totalImagesElem.text(imagesAmount + 1);
        let currId = 0;

        function updateCarousel() {
            moveCarousel(carousel, currId);
            currIdElem.text(currId + 1);
            imageTitle.text(images.eq(currId).find('.img-description').text());
        }

        prevBtn.click(() => {
            currId = currId === 0 ? imagesAmount : currId - 1;
            updateCarousel();
        })

        nextBtn.click(() => {
            currId = currId === imagesAmount ? 0 : currId + 1;
            updateCarousel();
        })

        overlay.click((e) => {
            if ($(e.target).attr('class') === 'image-full-view') {
                overlay.css('display', 'none');
            }
        });

        const gallery = $('.gallery');

        gallery.click((e) => {
            const $target = $(e.target);
            if ($target.hasClass('album-image')) {
                currId = ~~$target.data('id');
                overlay.css('display', 'flex');
                updateCarousel();
            }
        });
    }

    function displayAcceptPopup({ container, message, onAccept }) {
        container.css('display', 'flex');
        container.find('.message').text(message);
        container.find('.accept-buttons-container button:first-child').click(() => {
            container.css('display', 'none');
            onAccept();
        });
    }

    function openAcceptPopupOnFormButtonsClick() {
        const acceptMessageOverlay = $('.popup-accept-message-overlay');

        acceptMessageOverlay.click(e => {
            const $target = $(e.target);

            if ($target.attr('class') === 'popup-accept-message-overlay') {
                acceptMessageOverlay.css('display', 'none');
            }
        });

        acceptMessageOverlay.find('button + button').click(() => acceptMessageOverlay.css('display', 'none'));

        const form = $('form');

        const submitButton = form.find('input[type="submit"]');
        const resetButton = form.find('input[type="reset"]');

        submitButton.click((e) => {
            e.preventDefault();
            displayAcceptPopup({
                container: acceptMessageOverlay,
                onAccept: () => form.submit(),
                message: 'Отправить сообщение ?'
            });
        });

        resetButton.click((e) => {
            e.preventDefault();
            displayAcceptPopup({
                container: acceptMessageOverlay,
                onAccept: () => form[0].reset(),
                message: 'Отчистить форму ?'
            });
        });
    }

    function checkFormValidity(form) {
        const submitBtn = form.find('input[type="submit"]');
        const invalidInputs = form.find('.invalid');
        if (invalidInputs.length === 0) {
            submitBtn.removeAttr('disabled');
        } else {
            submitBtn.attr('disabled', true);
        }
    }

    function updateInputValidity({ input, error, isValid }) {
        if (isValid) {
            input.removeClass('invalid');
            input.addClass('valid');
            error.removeClass('visible');
        } else {
            input.removeClass('valid');
            input.addClass('invalid');
            error.addClass('visible');
        }
    }

    function checkField({ input, form, checkFunc }) {
        const error = form.find(`.error[for="${input.attr('name')}"]`);
        const isValid = checkFunc(input.val());

        updateInputValidity({ input, error, isValid });
        checkFormValidity(form);
    }

    function disableSubmitOnResetClick(form) {
        const resetBtn = form.find('input[type="reset"]');
        const submitBtn = form.find('input[type="submit"]');
        resetBtn.click(() => {
            const validFields = form.find('.valid');
            validFields.removeClass('valid');
            validFields.removeClass('invalid');
            submitBtn.attr('disabled', true)
        });
    }

    const blurCallbacks = (function () {
        const fieldsCallbacks = {
            fio: (value) => value.split(' ').filter(v => v.length > 0).length === 3,
            phone: (value) => value.match(/(^\+7|^\+3){1}([0-9]){8,10}$/),
            mail: (value) => value.match(/.+@.+(.com$|.ru$|.ua$|.co$|.io$)/),
            default: (value) => value.length > 0,
        };

        return ({ input, form, isDefault }) => checkField({
            input,
            form,
            checkFunc: isDefault ? fieldsCallbacks.default : fieldsCallbacks[input.attr('name')] || fieldsCallbacks.default
        });
    })();

    // function onEnterInput(input) {

    // }

    const helpMessage = $('<div class="helper-message-container"><span class="message"></span></div>');

    const buildHelpMessage = (function () {
        const messages = {
            fio: 'Введите вашу фамилию имя и отчество',
            phone: 'Введте ваш номер телефона',
            subject: 'Введите тему сообщения',
            mail: 'Введите вашу почту',
            default: 'Заполните поле'
        };

        return (element) => {
            const message = helpMessage.clone();
            message.slideUp();
            let text = messages[element.attr('name')];
            if (!text) {
                text = messages.default;
            }

            message.find('.message').text(text);

            return message;
        };
    })();

    function setUpHoverForElement(element) {
        let availableSlideDown = true;
        let availableSlideUp = false;
        let slideDownTimeout;
        let slideUpTimeout;

        const message = buildHelpMessage(element);

        element.before(message);

        let enterTime;
        let leaveTime;

        function onEnter() {
            enterTime = new Date().getTime();
            if (enterTime - leaveTime < 2000) {
                clearTimeout(slideUpTimeout);
                availableSlideUp = true;
            }
            slideDownTimeout = setTimeout(() => {
                if (availableSlideDown) {
                    availableSlideDown = false;
                    availableSlideUp = true;
                    message.slideDown(300);
                }
            }, 1000);
        }

        function onLeave() {
            leaveTime = new Date().getTime();
            if (leaveTime - enterTime < 1000) {
                clearTimeout(slideDownTimeout);
                message.slideUp(300, () => { availableSlideDown = true; });
                availableSlideUp = false;
            }

            if (availableSlideUp) {
                availableSlideUp = false;
                slideUpTimeout = setTimeout(() => {
                    message.slideUp(300, () => { availableSlideDown = true; });
                }, 2000);
            }
        }

        element.hover(
            onEnter,
            onLeave
        );
    }

    function checkContactForm() {
        const form = $(document.forms[0]);
        const elements = form.find('.invalid');

        $.each(elements, function () {
            const element = $(this);
            if (element.attr('name') !== 'dob') {
                // element.blur(() => blurCallbacks({ input: element, form }));
                setUpHoverForElement(element);
            }
        });

        // disableSubmitOnResetClick(form);
    }

    function checkMultiOptions({ error, unit, form, checkFunk }) {
        const options = unit.find('input');
        $.each(options, function () {
            $(this).click(() => {
                const isValid = checkFunk(options);
                updateInputValidity({
                    input: unit,
                    error,
                    isValid
                });

                checkFormValidity(form);
            });
        });
    }

    function checkTextTestOption({ error, unit, form }) {
        const input = unit.find('input');
        // input.blur(() => {
        //     updateInputValidity({
        //         input: unit,
        //         error,
        //         isValid: input.val().length > 0
        //     })

        //     checkFormValidity(form);
        // });
        setUpHoverForElement(input);
    }

    function checkTestUnits(units, form) {
        $.each(units, function () {
            const unit = $(this);
            // const error = form.find(`.error[for="${unit.attr('name')}"]`);

            // if (unit.hasClass('multi_option')) {
            //     let checkFunk;
            //     if (unit.hasClass('radio')) {
            //         checkFunk = (options) => options.filter((i, o) => o.checked).length > 0;
            //     } else {
            //         checkFunk = (options) => {
            //             const selectedCount = options.filter((i, o) => o.checked).length;
            //             return selectedCount >= 1 && selectedCount <= 3;
            //         };
            //     }

            //     checkMultiOptions({ error, unit, form, checkFunk });
            // }

            if (unit.hasClass('text')) {
                checkTextTestOption({ error, unit, form })
            }
        });
    }

    function checkTestForm() {
        const form = $(document.forms[0]);

        const fio = form.find('input[name="fio"]');
        fio.blur(() => blurCallbacks({ input: fio, form }));
        setUpHoverForElement(fio);

        const mail = form.find('input[name="mail"]');
        mail.blur(() => blurCallbacks({ input: mail, form }));
        setUpHoverForElement(mail);

        checkTestUnits(form.find('.test-unit'), form);

        disableSubmitOnResetClick(form);
    }

    function getStartIndex(date) {
        if (date === 1) {
            return date;
        }

        if (date === 0) {
            return -5;
        }

        return -(date - 2);
    }

    function getFormattedDateval(value) {
        return value < 10 ? `0${value}` : value;
    }

    function generateCalendarBody(dateString) {
        const date = new Date(dateString);
        const month = date.getMonth() + 1;
        const year = date.getFullYear();
        const daysDate = date.getDate();
        const daysInMonth = new Date(year, month, 0).getDate()
        const startIndex = getStartIndex(new Date(year, month - 1, 1).getDay());
        let html = '';

        for (let i = startIndex; i <= daysInMonth; i++) {
            const className = `calendar-option ${i === daysDate ? 'selected' : i < 1 ? 'hidden' : ''}`;
            html += `<div class="${className}">${getFormattedDateval(i)}</div>`;
        }

        return html;
    }

    function configureCalendar() {
        const calendar = $('.calendar');

        var currDate = new Date();
        const dateInput = $('input[name="dob"]');
        dateInput.attr('max', `${currDate.getFullYear()}-${getFormattedDateval(currDate.getMonth() + 1)}-${getFormattedDateval(currDate.getDate())}`);
        dateInput.click((e) => {
            if (e.offsetX < 97 && !calendar.hasClass('hidden')) {
                return;
            }

            calendar.toggleClass('hidden')
        });

        const optionsContainer = calendar.find('.calendar-options-container');
        optionsContainer.html(generateCalendarBody(dateInput.val()));

        const monthSelector = calendar.find('select[name="month"]');
        const yearSelector = calendar.find('select[name="year"]');

        const monthYearChanged = () => {
            dateInput.val(`${yearSelector.val()}-${monthSelector.val()}-01`);
            optionsContainer.html(generateCalendarBody(dateInput.val()));
        }

        monthSelector.change(monthYearChanged);
        yearSelector.change(monthYearChanged);

        optionsContainer.click((e) => {
            const $target = $(e.target);
            if ($target.hasClass('calendar-option')) {
                const selectedOption = optionsContainer.find('.selected');
                selectedOption.removeClass('selected');
                $target.addClass('selected');
                dateInput.val(`${yearSelector.val()}-${monthSelector.val()}-${e.target.innerHTML}`);
            }
        });

        dateInput.change(() => {
            optionsContainer.html(generateCalendarBody(dateInput.val()));
            const date = new Date(dateInput.val());
            monthSelector.val(getFormattedDateval(date.getMonth() + 1));
            yearSelector.val(date.getFullYear());
        });
    }

    function getWeekDay(day) {
        const days = {
            0: 'Воскреcенье',
            1: 'Понедельник',
            2: 'Вторник',
            3: 'Среда',
            4: 'Четверг',
            5: 'Пятница',
            6: 'Суббота'
        }

        return days[day];
    }

    function updateCurrentDate() {
        const date = $('.nav-item .date');
        const currDate = new Date();
        const weekDay = getWeekDay(currDate.getDay());
        const day = getFormattedDateval(currDate.getDate());
        const month = getFormattedDateval(currDate.getMonth() + 1);
        const year = currDate.getFullYear();
        const mins = getFormattedDateval(currDate.getMinutes());
        const hours = getFormattedDateval(currDate.getHours());
        const seconds = getFormattedDateval(currDate.getSeconds());

        date.text(`${day}.${month}.${year} ${weekDay} ${hours}:${mins}:${seconds}`);

        setTimeout(() => {
            updateCurrentDate();
        }, 1000);
    }

    function getCookie(cname) {
        const name = `${cname}=`;
        const decodedCookie = decodeURIComponent(document.cookie);
        var splitted = decodedCookie.split(';');
        for (let cookie of splitted) {
            while (cookie[0] == ' ') {
                cookie = cookie.substring(1);
            }
            if (cookie.indexOf(name) == 0) {
                return cookie.substring(name.length, cookie.length);
            }
        }

        return '';
    }

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCurrPageName() {
        const location = window.location.href.slice(window.location.href.lastIndexOf('/') + 1);
        if (location.length === 0) {
            return 'home';
        }

        return location;
    }

    function updateHistoryCookie() {
        const currPageName = getCurrPageName();
        const cookieName = `${currPageName}_hist`;
        let cookie = getCookie(cookieName);
        if (cookie.length === 0) {
            setCookie(cookieName, 1);
        } else {
            setCookie(cookieName, parseInt(cookie, 10) + 1);
        }

        const sessionHist = sessionStorage.getItem(cookieName);
        if (sessionHist === null) {
            sessionStorage.setItem(cookieName, 1);
        } else {
            sessionStorage.setItem(cookieName, ~~sessionHist + 1);
        }
    }

    function updateAllHistElement($element) {
        const pageName = $element.attr('id');
        const value = getCookie(`${pageName}_hist`);
        if (value.length === 0) {
            $element.text('0');
        } else {
            $element.text(value);
        }
    }

    function updateSessionHistElement($element) {
        const pageName = $element.attr('id');
        const value = sessionStorage.getItem(`${pageName}_hist`);
        if (value === null) {
            $element.text('0');
        } else {
            $element.text(value);
        }
    }

    function updateHistoryTables() {
        const allHistoryTable = $('#all-history');
        const sessionHistoryTable = $('#session-history');

        const totalHistElements = allHistoryTable.find('tr td+td');
        const sessionHistElements = sessionHistoryTable.find('tr td+td');

        for (let i = 0; i < totalHistElements.length; i++) {
            updateAllHistElement(totalHistElements.eq(i));
            updateSessionHistElement(sessionHistElements.eq(i));
        }
    }

    function playWithProxy() {
        win.wrapProxy = obj => new Proxy(obj, {
            get(target, key) {
                console.log(key)
                return target[key] || '';
            }
        });
    }

    $(async () => {
        playWithProxy();
        updateHistoryCookie();
        updateCurrentDate();

        if (isAlbumPage()) {
            await renderAlbumElements();
            makeGalleryClickable();
        }

        if (isContactPage()) {
            checkContactForm();
            configureCalendar();
            openAcceptPopupOnFormButtonsClick();
        }

        if (isTestPage()) {
            // checkTestForm();
            openAcceptPopupOnFormButtonsClick();
        }

        if (isStoryPage()) {
            updateHistoryTables();
        }
    });
})(window);