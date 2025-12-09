
document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".stat-number");
    const speed = 200; // lower = faster

    counters.forEach(counter => {
        const animate = () => {
            const target = +counter.getAttribute("data-count");
            const count = +counter.innerText;

            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(animate, 10);
            } else {
                counter.innerText = target;
            }
        };

        // run animation when section comes into view
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                animate();
                observer.disconnect();
            }
        });

        observer.observe(counter);
    });
});

