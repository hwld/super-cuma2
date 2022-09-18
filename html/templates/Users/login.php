<?php
/**
 * @var App\View\AppView $this
 */
?>
<?php $this->start('css') ?>
<style>
    /* 通常のボタン */
    #google-signin-btn {
        padding: 0px;
        border: 0px;
        background-color: transparent;
        outline: none;
    }

    #google-signin-btn>.focus {
        display: none;
    }

    #google-signin-btn>.active {
        display: none;
    }

    /* フォーカスされている状態のボタン */
    #google-signin-btn:focus>.normal {
        display: none;
    }

    #google-signin-btn:focus>.focus {
        display: inline-block;
    }

    #google-signin-btn:focus>.active {
        display: none;
    }


    /* アクティブ状態のボタン */
    #google-signin-btn:active>.normal {
        display: none;
    }

    #google-signin-btn:active>.focus {
        display: none;
    }

    #google-signin-btn:active>.active {
        display: inline-block;
    }
</style>
<?php $this->end()?>
<div class="d-flex align-items-center flex-column">
    <h4 class="mt-5">ログイン</h4>
    <div class="card mt-3" style="width: 350px;">
        <div class="card-body py-5">
            <?= $this->Form->create(null, [
                'id' => 'google-login-form',
                'class' => 'd-flex justify-content-center'
            ]) ?>
            <input name="idToken" hidden />
            <button id="google-signin-btn" type="button">
                <img class="normal" src="/img/btn_google_signin.png" />
                <img class="focus" src="/img/btn_google_signin_focus.png" />
                <img class="active" src="/img/btn_google_signin_pressed.png" />
            </button>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script type="module">
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.9.4/firebase-app.js";
    import {
        getAuth,
        signInWithPopup,
        signInWithCredential,
        GoogleAuthProvider
    } from 'https://www.gstatic.com/firebasejs/9.9.4/firebase-auth.js'

    const firebaseConfig = {
        apiKey: "AIzaSyB2PfzaXwSrEsRHcFqzw-7oqw4ZxmZVb-g",
        authDomain: "super-cuma.firebaseapp.com",
        projectId: "super-cuma",
        storageBucket: "super-cuma.appspot.com",
        messagingSenderId: "711766750052",
        appId: "1:711766750052:web:dcfc453eef9a27ad6a8071"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth();
    const provider = new GoogleAuthProvider();

    window.onload = () => {

        const googleSignInButton = document.querySelector('#google-signin-btn');
        googleSignInButton.addEventListener('click', async () => {
            try {
                const result = await signInWithPopup(auth, provider);

                const idToken = result.user.accessToken;
                const idTokenInput = document.querySelector('input[name="idToken"]');
                idTokenInput.value = idToken;

                const form = document.querySelector('form');
                form.submit();
            } catch (error) {
                console.error(error)
            }
        });
    }
</script>