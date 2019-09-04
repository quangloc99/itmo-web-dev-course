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
        container.classList.add('simple-window', 'container', 'closed');

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

    }

    show() {
        setTimeout(() => {
            this.updateHeight();
            this._container.classList.remove('closed');
        }, 0);
    }

    hide() {
        this.container.classList.add('closed');
    }

    updateHeight() {
        this._container.style.height = (
            this._titleElement.clientHeight +
            this._contentElement.clientHeight
        ) + "px";
    }

    _closeWindow() {
        this.hide();
        SimpleWindow._closedWindows.push(this);
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

    /**
     * @returns {string}
     */
    get title() {
        return this._titleElement.innerText;
    }

    /**
     * @param {string} val
     */
    set title(val) {
        this._titleElement.innerHTML = val;
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
