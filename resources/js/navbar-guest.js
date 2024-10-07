export function navbar() {
    return {
        navbarOpen: true,
        mobileMenuOpen: false,
        lastScrollY: 0,
        isHero: true,

        init() {
            const hero = document.getElementById("hero");

            if (hero) {
                new IntersectionObserver(
                    ([entry]) => {
                        this.isHero = entry.isIntersecting;
                    },
                    { threshold: [0, 0.1] }
                ).observe(hero);
            }

            window.addEventListener("scroll", () => {
                const { scrollY } = window;
                this.navbarOpen = scrollY <= this.lastScrollY;
                this.lastScrollY = scrollY;
                this.mobileMenuOpen = false;
            });
        },

        toggleMobileMenu() {
            this.mobileMenuOpen = !this.mobileMenuOpen;
        },

        get navbarClasses() {
            return {
                "transform translate-y-0 opacity-100 hover:shadow-md":
                    this.navbarOpen,
                "transform -translate-y-full opacity-0": !this.navbarOpen,
                "bg-transparent text-white": this.isHero,
                "bg-base-light text-base-dark": !this.isHero,
                "hover:bg-base-light hover:text-base-dark":
                    !this.mobileMenuOpen,
            };
        },

        get navClasses() {
            return {
                "flex bg-base-light text-base-dark": this.mobileMenuOpen,
                hidden: !this.mobileMenuOpen,
            };
        },
    };
}
