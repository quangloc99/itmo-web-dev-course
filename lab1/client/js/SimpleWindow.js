export class SimpleWindow {
    /**
     * @type {SimpleWindow[]}
     * @private
     */
    static checkCloseWindows() {
        // It's just two pointers technique.
        let newLength = 0;
        for (let i = 0; i < this._closedWindows.length; ++i) {
            const wind = this._closedWindows[i];
            if (wind.container.clientHeight === 0) {  // this condition is not really accurate, but meh, this is a lab.
                wind.container.remove();
            } else {
                this._closedWindows[newLength++] = wind;
            }
        }
        this._closedWindows.length = newLength;
    }

    /**
     * @param {string} title
     * @param {HTMLElement} content
     */
    constructor(title = '', content = null) {
        const container = document.createElement('div');
        container.classList.add('simple-window', 'container');

        const topBar = document.createElement('div');
        topBar.classList.add('top-bar');
        container.appendChild(topBar);

        const titleElement = document.createElement('div');
        titleElement.classList.add('title');
        titleElement.append(title);
        topBar.appendChild(titleElement);

        const closeButton = document.createElement('button');
        closeButton.classList.add('close');
        closeButton.append('x');
        closeButton.addEventListener('click',() => this._closeWindow());
        topBar.appendChild(closeButton);

        const contentElement = document.createElement('div');
        contentElement.classList.add('content');
        if (content) {
            contentElement.append(content);
        }
        container.appendChild(contentElement);

        this._container = container;
        this._titleElement = titleElement;
        this._contentElement = contentElement;

        SimpleWindow._closedWindows.push(this);
    }

    _closeWindow() {
        this._container.classList.add('closed');
    }


    /**
     * @returns {HTMLDivElement}
     */
    get container() {
        return this._container;
    }

    /**
     * @returns {HTMLDivElement}
     */
    get titleElement() {
        return this._titleElement;
    }

    /**
     * @returns {HTMLDivElement}
     */
    get contentElement() {
        return this._contentElement;
    }
}

function closeSimpleWindowLoopCheck() {
    SimpleWindow.checkCloseWindows();
    setTimeout(closeSimpleWindowLoopCheck, 250);  // this number can be adjusted,
                                                          // but we don't really need to do this too often
}

/**
 * @type {SimpleWindow[]}
 * @private
 */
SimpleWindow._closedWindows = [];
closeSimpleWindowLoopCheck();
