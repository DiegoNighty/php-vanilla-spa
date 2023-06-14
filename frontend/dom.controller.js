const cachedDOM = {}

function cacheDOM(route, node) {
    cachedDOM[route] = node.cloneNode(true);
}

function getCachedDOM(route) {
    return cachedDOM[route];
}

function loadPage(route) {
    const cachedHtml = getCachedDOM(route)
    const apiRoute = formatApiRoute(route);
    const browserRoute = formatBrowserRoute(route);

    if (cachedHtml) {
        setCachedPage(route, apiRoute, browserRoute, cachedHtml)
    } else {
        setPage(route, apiRoute, browserRoute)
    }
}

function setPage(route, apiRoute, browserRoute) {
    window.history.pushState({}, '', browserRoute);

    fetch(apiRoute)
        .then(response => {
            const page = document.getElementById('page');
            response.text()
                .then(text => {
                    const oldApp = document.getElementById('app');
                    page.removeChild(oldApp);

                    const newElementDOM = document.createElement('div');
                    newElementDOM.id = 'app';
                    newElementDOM.innerHTML = text;

                    page.appendChild(newElementDOM);

                    if (!isDynamic(text)) {
                        cacheDOM(route, newElementDOM)
                    }
                })
                .catch(err => console.log(err));
        }).catch(err => console.log(err));
}

function setCachedPage(route, apiRoute, browserRoute, html) {
    window.history.pushState({}, '', browserRoute);
    document.getElementById('app').replaceWith(html);
}

function formatApiRoute(route) {
    return 'app.php?route=' + route;
}

function formatBrowserRoute(route) {
    return 'index.php?route=' + route;
}

function isDynamic(text) {
    return text.startsWith('<dynamic>');
}

document.addEventListener('click', function (event) {
    if (event.target.matches('a')) {
        event.preventDefault();
        loadPage(event.target.getAttribute('href').replace(".php", ""));
    }
});