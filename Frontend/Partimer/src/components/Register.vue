<!DOCTYPE html>
<html>
<head>
  <title>Registrasi dan Login dengan Vue.js</title>
  <!-- Sertakan Vue.js -->
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>
<body>
  <div id="app">
    <div>
      <button @click="currentPage = 'login'">Login</button>
      <button @click="currentPage = 'signup'">Registrasi</button>
    </div>

    <login-form v-if="currentPage === 'login'" @login="login"></login-form>
    <signup-form v-else @signup="signup"></signup-form>
  </div>

  <script>
    Vue.component('login-form', {
      data() {
        return {
          username: '',
          password: ''
        };
      },
      template: `
        <div>
          <h2>Login</h2>
          <form @submit="login">
            <input type="text" v-model="username" placeholder="Username">
            <input type="password" v-model="password" placeholder="Password">
            <button type="submit">Login</button>
          </form>
        </div>
      `,
      methods: {
        login() {
          // Kode untuk proses login disini
          console.log('Login dengan data:', { username: this.username, password: this.password });
          this.$emit('login');
        }
      }
    });

    Vue.component('signup-form', {
      data() {
        return {
          username: '',
          password: ''
        };
      },
      template: `
        <div>
          <h2>Registrasi</h2>
          <form @submit="signup">
            <input type="text" v-model="username" placeholder="Username">
            <input type="password" v-model="password" placeholder="Password">
            <button type="submit">Registrasi</button>
          </form>
        </div>
      `,
      methods: {
        signup() {
          // Kode untuk proses registrasi disini
          console.log('Registrasi dengan data:', { username: this.username, password: this.password });
          this.$emit('signup');
        }
      }
    });

    new Vue({
      el: "#app",
      data: {
        currentPage: "login"
      },
      methods: {
        login() {
          // Kode yang ingin Anda jalankan saat login
        },
        signup() {
          // Kode yang ingin Anda jalankan saat registrasi
        }
      }
    });
  </script>
</body>
</html>
