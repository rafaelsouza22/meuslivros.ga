<header>
    <nav>
        <h1><a href="index.php">MeusLivros</a></h1>
        <div id="menu">
            <form action="buscar.php" method="get" id="menu-form">
                <input type="search" name="buscar" id="buscar" placeholder="Buscar">
                <button type="submit"><img src="./img/lupa.png" alt=""></button>
            </form>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="./login.php">Entrar</a></li>
                <?php echo ((isset($_SESSION['id_usuario']) && !empty($_SESSION['email_usuario']))) ? " <li><a href='cadastrar.php'>Cadastrar</a></li> " : ''; ?>
                <?php echo ((isset($_SESSION['id_usuario']) && !empty($_SESSION['email_usuario']))) ? " <li><a href='atualizar.php'>Atualizar</a></li> " : ''; ?>
                <?php echo ((isset($_SESSION['id_usuario']) && !empty($_SESSION['email_usuario']))) ? " <li><a href='sair.php'>Sair</a></li> " : ''; ?>
            </ul>

        </div>
        <button onclick="menu()" id="btn-menu">MENU</button>
    </nav>
</header>
<script>
    let status = 0;

    function menu() {
        let menu = document.querySelector('#menu');
        if (status) {
            menu.style.display = 'none';
            status = 0;
        } else {
            menu.style.display = 'block';
            menu.style.transform = 'translateX(-320px)';
            status = 1;
        }
    }
</script>