<!-- login modal -->
<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content" id="loginModal">
      <div class="modal-header">
        <h2 id="modal-login-text">welcome back</h2>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<img id="login-duck-image" src="images/duckcloth.png"/>
        <form id="login-form">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              id="login-username"
              placeholder="username"
            />
            <small class="invalid-feedback">username required</small>
          </div>
          <div className="form-group">
            <input
              type="password"
              class="form-control"
              id="login-pwd"
              placeholder="password"
            />
            <small class="invalid-feedback">password required</small>
            <small id="login-feedback"></small>
          </div>
          <button
            type="submit"
            class="btn btn-light btn-sm"
          >
            login
          </button>
        </form>
      </div>
      <div class="modal-footer">
        <a id="switch-to-register" href="#" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Need an account? Sign up here</a>
      </div>
    </div>
  </div>
</div>
<!-- signup modal -->
<div class="modal fade" id="registerModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="modal-register-text">first time?
        	<img id="register-duck-image" src="images/duck.png"/>
        </h2>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="register-form">
          <div class="form-group">
            <input
              type="email"
              class="form-control"
              id="register-email"
              placeholder="email address"
            />
            <small class="invalid-feedback">email address required</small>
          </div>
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              id="register-username"
              placeholder="username"
            />
            <small class="invalid-feedback">username required</small>
          </div>
          <div className="form-group">
            <input
              type="password"
              class="form-control"
              id="register-pwd"
              placeholder="password"
            />
            <small class="invalid-feedback">password required</small>
            <small id="register-feedback"></small>
          </div>
          <button
            type="submit"
            class="btn btn-light btn-sm"
          >
            sign up
          </button>
        </form>
      </div>
      <div class="modal-footer">
        <a id="switch-to-login" href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Have an account? Sign in here</a>
      </div>
    </div>
  </div>
</div>