/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

import './styles/app.scss';

const initStarRating = () => {
    const inputFormStars = document.getElementById('review_seller_stars');
    const starsSelectorElms = document.getElementsByClassName('star-radio-elm');
    if (inputFormStars && starsSelectorElms) {
        Array.from(starsSelectorElms).forEach((elm) => {
            elm.addEventListener('click', (e) => {
                console.log(e.target);
                inputFormStars.value = e.target.value;
            });
        });
    }
}



document.addEventListener('DOMContentLoaded', () => {
    initStarRating();
});
