
    <ul class="nav navbar-nav navbar-right">

            <li><a href="#">О Компании</a></li>
            <li><a href="#">Помощь</a></li>
    </ul>
    <form action="controllers/act.php" method="POST" class="navbar-form navbar-right">
    		<input type="hidden" name="act" value="login">
            <input name="login"  class="form-control" placeholder="Имя пользователя">
            <input name="password" type="password" class="form-control" placeholder="Пароль">
            <button type="button submit" class="btn btn-success">Вход</button>
    </form>