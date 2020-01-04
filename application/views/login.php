<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Tefa App</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/plugins/css/bulma.css"> 
</head>
<body style="height: 100%; width: 100%; position: fixed;" class="has-background-white-ter">
    <div class="section">
        <div class="columns">
            <div class="column is-4 is-offset-4 card" style="margin-top: 4%;">
                    <div class="card-content">
                    <h1 class="title has-text-centered">TOM 3'20</h1>
                    <h2 class="subtitle is-6 has-text-centered">TEFA ORDER MANAGEMENT</h1>
                    <?php if ( isset($login_err) ) : ?>
                        <div class="notification has-background-danger has-text-white">
                            <span><?= $login_err['note']; ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="field">
                    <?= form_open('Auth_Controller/do_login'); ?>
                        <div class="control">
                            <input type="text" name="username" class="input"> <br> <br>
                            <input type="password" name="password" class="input"> <br> <br>
                            <button type="submit" class="button input is-primary" name="submit">Login</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column is-4 is-offset-4" style="margin-top: 20px;">
                <h2 class="subtitle is-6 has-text-centered"> &copy <b> Multimedia Creative Community </b> <br> SMKN 3 Bandung 2019</h2>
            </div>
        </div>
    </div>
</body>
</html>