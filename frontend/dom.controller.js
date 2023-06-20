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

                    const scriptElement = document.createElement("script");
                    analyzeScript(text, scriptElement);
                    newElementDOM.appendChild(scriptElement);

                    page.appendChild(newElementDOM);

                    if (!isDynamic(text)) {
                        cacheDOM(route, newElementDOM)
                    }
                })
                .catch(err => console.log(err));
        }).catch(err => console.log(err));
}

function analyzeScript(htmlString, scriptElement) {
    const scriptRegex = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi;
    const scriptTags = htmlString.match(scriptRegex);

    if (!scriptTags) {
        return;
    }

    for (let i = 0; i < scriptTags.length; i++) {
        const scriptContent = scriptTags[i].replace(/<\/?script>/g, '');
        scriptElement.textContent += scriptContent
    }
}

function setCachedPage(route, apiRoute, browserRoute, html) {
    window.history.pushState({}, '', browserRoute);
    document.getElementById('app').replaceWith(html);
}

function formatApiRoute(route) {
    const routedApi = 'app.php?route=' + route
    const token = localStorage.getItem('lyricnote_token')

    if (token) {
        return routedApi + '&token=' + token;
    } else {
        return routedApi;
    }
}

function formatBrowserRoute(route) {
    return 'index.php?route=' + route;
}

function isDynamic(text) {
    return text.startsWith('<dynamic>');
}

document.addEventListener('click', function (event) {
    let target = event.target

    if (target.matches('a')) {
        event.preventDefault();
        loadPage(target.getAttribute('href').replace(".php", ""));
        return;
    }

    let parent = target.parentElement
    if (parent && parent.matches('a')) {
        event.preventDefault()
        loadPage(parent.getAttribute('href').replace(".php", ""));
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const route = window.location.search.replace("?route=", "");
    loadPage(route);
});