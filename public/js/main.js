
// ***********************************************
// **               Cookie Helper               **
// ***********************************************

function getCookie (cookieName) {

    const match = document.cookie.match(new RegExp('(^| )' + cookieName + '=([^;]+)'));

    if (match) {
        return match[2];
    } else {
        return null;
    }
}
  
function setCookie (cookieName, cookieValue) {

    document.cookie = cookieName + '=' + cookieValue;
}

// ***********************************************
// **               Custom Select               **
// ***********************************************

function initSelects() {

    window.addEventListener('click', function (event) {

        let customSelects = document.querySelectorAll('.select-box');

        for (let i = 0; i < customSelects.length; i++) {

            let thisSelect = customSelects[i];

            if (thisSelect.contains(event.target)) {
                thisSelect.classList.toggle('open');
            } else {
                thisSelect.classList.remove('open');
            }

        }

    });
    
    const options = document.querySelectorAll('.select-box .select-option');
    
    for (let i = 0; i < options.length; i++) {
    
        options[i].addEventListener('click', function() {
    
            if (this.classList.contains('selected')) return;
    
            const previous = this.parentNode.querySelector('.select-option.selected');
            if (previous) {
                previous.classList.remove('selected');
            }
            
            this.classList.add('selected');
            //this.closest('.select').querySelector('.select-title span').textContent = this.textContent;
    
        });
    }

}

// ***********************************************
// **               Color Scheme                **
// ***********************************************

var defaultColorScheme = 'theme06';

function setColorScheme(colorScheme) {

    if (colorScheme === null) {
        setCookie('color-scheme', defaultColorScheme);
    }

    document.body.setAttribute('class', getCookie('color-scheme'));

}

function initSelectColorScheme() {

    const colorOptions = document.querySelectorAll('#color-scheme .select-option');

    for (let i = 0; i < colorOptions.length; i++) {

        colorOptions[i].addEventListener ('click', function () {

            const value = this.getAttribute('data-value');
            setCookie('color-scheme', value);
            setColorScheme(value);

        });
    }

    const activeColorOption = document.querySelector('#color-scheme [data-value="'+getCookie('color-scheme')+'"]');
    activeColorOption.classList.add('selected');
}
    
// ***********************************************
// **                 Tooltips                  **
// ***********************************************

const tooltip = document.getElementById('tooltip');
let tooltipDebounce = false;

function initTooltips() {

    const tooltips = document.querySelectorAll('[data-tooltip]');

    for (let i = 0; i < tooltips.length; i++) {

        tooltips[i].addEventListener('mouseenter', function () {
            tooltip.classList.add('show');
        });

        tooltips[i].addEventListener('mouseleave', function () {
            tooltip.classList.remove('show');
        });

        tooltips[i].addEventListener('mousemove', function (event) {

            if (!tooltipDebounce) {
                let text = event.currentTarget.getAttribute('data-tooltip');
                tooltip.innerHTML = text;
                tooltip.style.left = (event.pageX + 10) + 'px';
                tooltip.style.top = (event.pageY + 10) + 'px';

                tooltipDebounce = true;
                setTimeout(function () {
                    tooltipDebounce = false;
                }, 25);
            } 

        });
    }
}

// ***********************************************
// **                   Tabs                    **
// ***********************************************

function deactivateTabs(object = document) {
    
    const tabContent = object.getElementsByClassName('tab-content');
    for (let i = 0; i < tabContent.length; i++) {
        tabContent[i].classList.remove('active');
    }

    const tabLinks = object.getElementsByClassName('tab-link');
    for (let i = 0; i < tabLinks.length; i++) {
        tabLinks[i].classList.remove('active');
    }
}

function activateTab(object = document) {

    deactivateTabs(object);

    if (getCookie('active-tab') === null) {
        setCookie('active-tab','all-clients');
    }

    let cname = getCookie('active-tab');
    targetedButton = object.querySelector('[data-cname="' + cname + '"]');
    targetedTab = object.querySelector('#' + cname);
    
    if (targetedButton === null || targetedTab === null) { // -> in case cookie contain value (cname) that no longer exist in logs
        // -> fallback to default (all-clients)

        if (cname == 'all-clients') // -> if this result as true something is terribly wrong
            throw new Error('function activateTab failed successfully'); // -> just stop to prevent endless loop
        
            setCookie('active-tab','all-clients');
        activateTab(object);
        return;
    }

    targetedButton.classList.add('active');
    targetedTab.classList.add('active');
}


function initTabs() {

    const tabLinks = document.getElementsByClassName('tab-link');

    for (let i = 0; i < tabLinks.length; i++) {
        tabLinks[i].addEventListener('click', function (event) {

            let cname = event.currentTarget.getAttribute('data-cname');
            setCookie('active-tab',cname);
            activateTab();

        });
    }
}

// ***********************************************
// **                   Dates                   **
// ***********************************************

var defaultDateTime = 'en';

function updateDateTimes(format = getCookie('date-time')) {

    if (format == null) {
        setCookie('date-time', defaultDateTime);
        format = defaultDateTime;
    }

    const dateTimes = document.querySelectorAll('[data-datetime]');

    for (let i = 0; i < dateTimes.length; i++) {
        const dateData = JSON.parse(dateTimes[i].getAttribute('data-datetime'));
        dateTimes[i].innerHTML = dateData[format];
    }

    const activeDateTime = document.querySelector('#date-format [data-value="'+format+'"]');
    activeDateTime.classList.add('selected');
}

function initDateTimes() {

    const dateTimeOptions = document.querySelectorAll('#date-format .select-option');

    for (let i = 0; i < dateTimeOptions.length; i++) {

        dateTimeOptions[i].addEventListener ('click', function () {

            const value = this.getAttribute('data-value');
            setCookie('date-time', value);
            updateDateTimes(value);

        });
    }

    const activeColorOption = document.querySelector('#color-scheme [data-value="'+getCookie('color-scheme')+'"]');
    activeColorOption.classList.add('selected');
}


// ***********************************************
// **                  Update                   **
// ***********************************************

function updateRoutine (newContent) {

    let statusTemp = document.createElement('div');
    statusTemp.innerHTML = newContent.statusContent.trim();

    let journalTemp = document.createElement('div');
    journalTemp.innerHTML = newContent.journalContent.trim();

    activateTab(journalTemp);

    document.getElementById('journal').replaceWith(journalTemp.firstChild);
    document.getElementById('status').replaceWith(statusTemp.firstChild);

    document.getElementById('last-update').innerHTML = newContent.lastUpdate;

    initTabs();
    initTooltips();
    updateDateTimes();
}

function loadData(init = false) {

    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {

        if (xmlhttp.readyState == XMLHttpRequest.DONE) {

            if (xmlhttp.status == 200) {
                let result = JSON.parse(xmlhttp.responseText);

                updateRoutine(result);

                if (!init) return;
                document.getElementById('loader').classList.remove('show');

            } else { 
                // something else than 200 was returned - TODO should i bother myself to handle this error ? (-_-).zZ
            }
        }
    };

    xmlhttp.open('GET', 'data.php', true);
    xmlhttp.send();
}

// Before we start check for cookies. Since script relies on them.
if (!navigator.cookieEnabled) throw new Error('cookies must be enabled in your browser');

// ------------------ START ------------------

// init custom selects
initSelects();
// Color Scheme
setColorScheme(getCookie('color-scheme'));
initSelectColorScheme();
// dateTime
initDateTimes();
// initial load
loadData(true);
// update load
var updateData = setInterval(loadData, 60000);
