import { Controller } from '@hotwired/stimulus';
import { getComponent } from '@symfony/ux-live-component';

export default class extends Controller {
    static values = { siteKey: String, hl: String };
    static targets = ['error'];

    async initialize() {
        const component = await getComponent(this.element);

        window.recaptcha_render = () => {
            if (document.getElementById('recaptcha-widget')) {
                grecaptcha.render('recaptcha-widget', {
                    'sitekey' : this.siteKeyValue,
                    'callback': (token) => {
                        component.set('captchaToken', token);
                        this.errorTarget.classList.remove('d-block');
                    }
                });
            }
        };

        const src = `https://www.google.com/recaptcha/api.js?onload=recaptcha_render&render=explicit&hl=${this.hlValue}`;

        if (!document.querySelector(`script[src="${src}"]`)) {
            const script = document.createElement('script');
            script.async = true;
            script.defer = true;
            script.src =  src;
            document.getElementById('recaptcha').appendChild(script);
        }
    }
}