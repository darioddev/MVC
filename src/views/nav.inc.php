<nav class="sidebar close">
    <header>
        <div class="text logo">
            <span class="name">
                DARIO QUINDE QUIÑONEZ
            </span>
            <span class="rol">
                ALUMNO
            </span>
        </div>
        <i class="bx bx-menu toogle"></i>
    </header>

    <div class="menu-bar">
        <div class="menu">

            <ul class="menu-links">
                <li class="nav-link">
                    <a href="<?php echo $ruta . "Home" ?>">
                        <i class="bx bx-home-alt icon"></i>
                        <span class="text nav-text">Home</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="<?php echo $ruta . "Peliculas" ?>">
                        <i class="fas fa-film icon"></i>
                        <span class="text nav-text">Peliculas</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="<?php echo $ruta . "Discos" ?>">
                        <i class="fas fa-compact-disc icon"></i>
                        <span class="text nav-text">Discos</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="<?php echo $ruta . "Libros" ?>">
                        <i class="bx bx-book-open icon"></i>
                        <span class="text nav-text">Libros</span>
                    </a>
                </li>

            </ul>
        </div>
        <div class="bottom-content">
            <li class="mode">
                <div class="sun-moon">
                    <i class="bx bx-moon icon moon"></i>
                    <i class="bx bx-sun icon sun"></i>
                </div>
                <span class="mode-text text">Modo Oscuro</span>
                <div class="toogle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>
</nav>
<script>
    try {
        const body = document.querySelector("body"),
            sidebar = body.querySelector("nav"),
            toogle = body.querySelector(".toogle"),
            modeSwitch = body.querySelector(".toogle-switch"),
            modeText = body.querySelector(".mode-text");

        if (!body || !sidebar || !toogle || !modeSwitch || !modeText) {
            throw new Error("Elementos DOM no encontrados.");
        }

        const setMode = (mode) => {
            body.classList.toggle("dark", mode === "Dark mode");
            modeText.innerText = mode;
            localStorage.setItem("background", mode);
        };

        modeSwitch.addEventListener("click", () => {
            const currentMode = localStorage.getItem("background");
            const newMode = currentMode === "Dark mode" ? "Light mode" : "Dark mode";
            setMode(newMode);
        });

        document.addEventListener("DOMContentLoaded", () => {
            const storedMode = localStorage.getItem("background");
            if (storedMode) {
                setMode(storedMode);
            }
        });

        toogle.addEventListener("click", () => sidebar.classList.toggle("close"));
    } catch (error) {
        console.error(`Error en initializeUI: ${error.message}`);
    }
</script>