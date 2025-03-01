<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>新規登録</title>
        @vite(['resources/js/app.js', 'resources/js/script.js', 'resources/css/app.css', 'resources/css/style.css'])
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="register-box">
            <div class="container register-container">
                <h1>ユーザー新規登録画面</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- パスワード -->
                    <input type="password" name="password" id="password" placeholder="パスワード" required>
                    <!-- メールアドレス -->
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="メールアドレス" required>

                    <!-- 新規登録ボタン -->
                    <div class="button-group user-button-group">
                        <button type="submit" class="btn btn-register">新規登録</button>
                        <a href="{{ route('login') }}" class="btn btn-login">戻る</a>
                    </div>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
