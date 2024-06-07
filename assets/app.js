/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import 'cookieconsent';

window.addEventListener("load", function(){
    window.cookieconsent.initialise({
        "palette": {
            "popup": {
                "background": "#003366",
                "text": "#FFFFFF"
            },
            "button": {
                "background": "#0FCFB7",
                "text": "#000000"
            }
        },
        "content": {
            "message": "Nous utilisons les cookies afin de vous garantir une meilleure expérience sur le site.",
            "dismiss": "D'accord !",
            "link": "En savoir plus"
        }
    });
});
