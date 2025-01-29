<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ログイン</title>
        @vite(['resources/js/app.js', 'resources/js/script.js', 'resources/css/app.css', 'resources/css/style.css'])
    </head>
    <body>
        <div class="login-box">
            <div class="container login-container">
                <h1>ユーザーログイン画面</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- パスワード -->
                    <input type="password" name="password" id="password" placeholder="パスワード" required>
                    <!-- メールアドレス -->
                    <input type="email" name="email" id="email" placeholder="メールアドレス" required>

                    <!-- 新規登録ボタン -->
                    <div class="button-group">
                        <a href="{{ route('register') }}" class="btn btn-register">新規登録</a>
                        <button type="submit" class="btn btn-login">ログイン</button>
                    </div> 
                </form>
            </div>
        </div>    
    </body>
</html>
