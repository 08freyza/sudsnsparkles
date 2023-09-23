/**
 * Custom Main Javascript
 * Made by Freyza Kusuma
 */
document.addEventListener('DOMContentLoaded', () => {
    "use strict";

    // Loader
    const spinnerWrapperEl = document.querySelector('.spinner-wrapper');
    if (spinnerWrapperEl) {
        window.addEventListener('load', () => {
            spinnerWrapperEl.style.opacity = '0';

            setTimeout(() => {
                spinnerWrapperEl.style.display = 'none';
            }, 500);

            setTimeout(() => {
                spinnerWrapperEl.remove()
            }, 1100);
        });
    }

    /**
     * Correct scrolling position upon page load for URLs containing hash links.
     */
    window.addEventListener('load', function(e) {
        if (window.location.hash) {
            if (document.querySelector(window.location.hash)) {
                setTimeout(() => {
                    let section = document.querySelector(window.location.hash);
                    let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
                    window.scrollTo({
                        top: section.offsetTop - parseInt(scrollMarginTop),
                        behavior: 'smooth'
                    });
                }, 100);
            }
        }
    });

    const checkMainSection = document.querySelector("#main-section");
    const sections = document.querySelectorAll("section");
    const navLi = document.querySelectorAll(".nav-link");

    // console.log(checkMainSection)

    if (checkMainSection) {
        window.addEventListener('scroll', () => {
            var current = "";

            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (scrollY >= sectionTop - 101) {
                    current = section.getAttribute("id");
                    console.log(current);
                }
            });

            navLi.forEach((li) => {
                li.classList.remove("active");
                if (li.getAttribute("href") == ("#" + current)) {
                    li.classList.add("active");
                    console.log("we did");
                }
            });
        })
    }

    try {
        // const togglePassword = document.querySelector('#togglePassword');
        // const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        // const password = document.querySelector('#password');
        // const confirmPassword = document.querySelector('#confirmpassword');

        // togglePassword.addEventListener('click', () => {
        //     const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        //     password.setAttribute('type', type);

        //     const className =  togglePassword.className === 'bi bi-eye' ? 'bi bi-eye-slash' : 'bi bi-eye';
        //     togglePassword.setAttribute('class', className);
        // });

        // toggleConfirmPassword.addEventListener('click', () => {
        //     const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        //     confirmPassword.setAttribute('type', type);

        //     const className =  toggleConfirmPassword.className === 'bi bi-eye' ? 'bi bi-eye-slash' : 'bi bi-eye';
        //     toggleConfirmPassword.setAttribute('class', className);
        // });

        // is-invalid class on password

        const isInvalidClass = document.querySelector('.is-invalid');
        const formControl = document.querySelectorAll('.form-control');
        const formSelect = document.querySelectorAll('.form-select');
        // const firstName = document.querySelector('#firstname');
        // const lastName = document.querySelector('#lastname');
        // const email = document.querySelector('#email');
        // const username = document.querySelector('#username');

        if(isInvalidClass) {
            formControl.forEach(element => {
                element.addEventListener('input', () => {
                    const isInvalid = element
                    isInvalid.classList.remove("is-invalid")
                });
            });

            formSelect.forEach(element => {
                element.addEventListener('change', () => {
                    const isInvalid = element
                    isInvalid.classList.remove("is-invalid")
                });
            });
            // firstName.addEventListener('input', () => {
            //     const isInvalid = firstName
            //     isInvalid.classList.remove("is-invalid")
            // });

            // lastName.addEventListener('input', () => {
            //     const isInvalid = lastName
            //     isInvalid.classList.remove("is-invalid")
            // });

            // email.addEventListener('input', () => {
            //     const isInvalid = email
            //     isInvalid.classList.remove("is-invalid")
            // });

            // username.addEventListener('input', () => {
            //     const isInvalid = username
            //     isInvalid.classList.remove("is-invalid")
            // });

            // password.addEventListener('input', () => {
            //     const isInvalid = password
            //     // const eyeIcon = togglePassword
            //     isInvalid.classList.remove("is-invalid")
            //     // eyeIcon.setAttribute('class', 'bi bi-eye');
            // });

            // confirmPassword.addEventListener('input', () => {
            //     const isInvalid = confirmPassword
            //     // const eyeIcon = toggleConfirmPassword
            //     isInvalid.classList.remove("is-invalid")
            //     // eyeIcon.setAttribute('class', 'bi bi-eye');
            // });
        }

        // // Cart dropdown won't be showed on mobile mode
        // let cartDropdown = document.querySelector('.cart-dropdown')

        // if (select('#navbar').classList.contains('navbar-mobile')) {
        // cartDropdown.classList.add('d-block')
        // } else {
        // cartDropdown.classList.remove('d-block')
        // }
    } catch (error) {
        // console.log("Just ignore this, bro! Don't worry :)")
        console.log(error);
    }
})
