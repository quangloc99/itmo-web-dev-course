/**
 * @param {string} arg
 */

import {SimpleWindow} from "../SimpleWindow.js";

export const ineedmeme = {
    checkEasterEgg(arg) {
        return arg.trim() === 'ineedmeme';
    },

    performEasterEgg() {
        const xhrGetContent = new XMLHttpRequest();
        const wind = new SimpleWindow('You need meme??? Here you go :)');
        wind.contentElement.classList.add('ineedmeme');
        document.body.appendChild(wind.container);

        function handleError() {
            wind.contentElement.append('An error has been occurred :(.')
            wind.show();
        }

        xhrGetContent.addEventListener('load', function () {
            /**
             * @type {HTMLDocument}
             */
            const doc = this.response;
            const title = doc.title.replace(' - Imgflip', '')
            const titleElm = document.createElement('h2');
            titleElm.innerHTML = title;
            const img = doc.getElementById('im');
            img.addEventListener('load', () => {
                setTimeout(() => wind.updateHeight(), 0.1);
            });

            const memeId = img.src.split('/')[3].split('.')[0];

            const link = document.createElement('a');
            link.href = 'https://imgflip.com/i/' + memeId;
            link.appendChild(img);

            const noteElm = document.createElement('ul');
            noteElm.innerHTML = `
                <li>Meme will take a bit time to load. Please wait.</li>
                <li>Meme source is from <a href="https://imgflip.com/">imgflip</a>. Click the image for the full site.</li>
                <li>Click the submit button again for more random meme!!!</li>
                <li>I am sorry for the trash meme, if they are too bad :).</li>
            `;

            wind.contentElement.append(titleElm);
            wind.contentElement.appendChild(link);
            wind.contentElement.appendChild(noteElm);
            wind.show();
        });

        xhrGetContent.responseType = 'document';
        xhrGetContent.addEventListener('error', handleError);

        const currentNormalizedPath = new URL(window.location.href).pathname;
        let parts = currentNormalizedPath.split('/');
        parts.pop();
        xhrGetContent.open('GET', parts.join('/') + '/src/easter-eggs/ineedmeme.php');
        xhrGetContent.send();
    },
};
