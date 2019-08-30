"use strict";


const form = {
    element: document.getElementById('data-form'),
    init() {
        for (const obj of Object.values(this.components)) {
            obj.init();
        }
    },

    components: {
        pointX: {
            name: 'x',
            range: {low: -3, high: 5},
            container: document.getElementById("point-x-input"),
            element: document.createElement('input'),

            init() {
                this.element.type = 'text';
                this.element.name = this.name;
                this.container.appendChild(this.element);

                this.element.addEventListener('input', event => {
                    this.element.classList.remove('error')
                });

                form.element.addEventListener("submit", event=> {
                    // it will be nicer to have a function for validating, but meh.
                    let value = this.element.value.replace(/,/g, '.');
                    let num = Number(value);
                    if (!isNaN(num) && num >= this.range.low && num <= this.range.high) return;

                    this.element.classList.add('error');
                    event.preventDefault();
                    return false;
                });
            },
        },

        pointY: {
            name: 'y',
            range: {low: -3, high: 5},
            container: document.getElementById('point-y-input'),
            init() {
                for (let value = this.range.low; value <= this.range.high; ++value) {
                    const radioElm = document.createElement('input');
                    radioElm.type = 'radio';
                    radioElm.name = this.name;
                    radioElm.value = '' + value;

                    const labelElm = document.createElement('label');
                    labelElm.appendChild(radioElm);
                    labelElm.append(value);
                    this.container.appendChild(labelElm);
                }

                // will be another way to do it better but this is fine :))
                this.container.getElementsByTagName('input')[0].checked = true;
            },
        },

        parameterR: {
            name: 'r',
            range: {low: 1, high: 5},
            container: document.getElementById('parameter-r-input'),
            init() {
                const selectElm = document.createElement('select');
                selectElm.name = this.name;
                for (let value = this.range.low; value <= this.range.high; ++value) {
                    const optionElm = document.createElement('option');
                    selectElm.appendChild(optionElm);
                    optionElm.value = value;
                    optionElm.append(value);
                }
                this.container.appendChild(selectElm);
            }
        }
    },
};

form.init();

