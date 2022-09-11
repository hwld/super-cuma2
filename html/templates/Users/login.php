<?php
/**
 * @var App\View\AppView $this
 */
?>
<div class="d-flex justify-content-center">
    <button class="btn btn-primary google-signIn">GoogleでSignIn</button>
    <input hidden name="csrfToken"
        value="<?= $this->request->getAttribute('csrfToken'); ?>" />
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
        const googleSignInButton = document.querySelector('.google-signIn');
        const csrfToken = document.querySelector('input[name="csrfToken"]').value;
        googleSignInButton.addEventListener('click', async () => {
            try {
                const result = await signInWithPopup(auth, provider);
                const idToken = result.user.accessToken;

                const content = await fetch("/users/login", {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json",
                        'X-CSRF-Token': csrfToken,
                    },
                    body: JSON.stringify({
                        idToken,
                    }),
                })
                //　TODO: どうにかサーバー側で遷移させたい
                window.location.reload();
            } catch (error) {
                console.error(error)
            }
        });
    }
</script>