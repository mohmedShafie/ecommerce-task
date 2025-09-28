<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('vuexy-layout/assets')}}/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin Login - task</title>

    <meta name="description" content="Admin login for task - Smart Medication Community Platform" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('vuexy-layout/assets')}}/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <style>
      /* Using system fonts as fallback since Public Sans files are not available locally */
      body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      }
    </style>

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('vuexy-layout/assets')}}/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{asset('vuexy-layout/assets')}}/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{asset('vuexy-layout/assets')}}/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('vuexy-layout/assets')}}/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('vuexy-layout/assets')}}/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('vuexy-layout/assets')}}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('vuexy-layout/assets')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{asset('vuexy-layout/assets')}}/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="{{asset('vuexy-layout/assets')}}/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{asset('vuexy-layout/assets')}}/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('vuexy-layout/assets')}}/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="{{asset('vuexy-layout/assets')}}/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{asset('vuexy-layout/assets')}}/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('vuexy-layout/assets')}}/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
      <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="{{asset('vuexy-layout/assets')}}/img/illustrations/auth-login-illustration-light.png"
              alt="auth-login-cover"
              class="img-fluid my-5 auth-illustration"
              data-app-light-img="illustrations/auth-login-illustration-light.png"
              data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

            <img
              src="{{asset('vuexy-layout/assets')}}/img/illustrations/bg-shape-image-light.png"
              alt="auth-login-cover"
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png" />
          </div>
        </div>
        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
          <div class="w-px-400 mx-auto">
            <!-- Logo -->
            <div class="app-brand mb-4">

            </div>
            <!-- /Logo -->
            <h3 class="mb-1 fw-bold">Welcome to task! 👋</h3>
            <p class="mb-4">Please sign-in to your admin account to manage the platform</p>

            <form id="formAuthentication" class="mb-3" action="{{ route('admin.login') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                  type="email"
                  class="form-control @error('email') is-invalid @enderror"
                  id="email"
                  name="email"
                  value="{{ old('email') }}"
                  placeholder="Enter your email address"
                  required
                  autofocus />
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <a href="#" onclick="alert('Password reset functionality will be available soon.')">
                    <small>Forgot Password?</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                    required />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                  <label class="form-check-label" for="remember"> Remember Me </label>
                </div>
              </div>

              @if (session('status'))
                <div class="alert alert-success mb-3" role="alert">
                  {{ session('status') }}
                </div>
              @endif

              @if (session('error'))
                <div class="alert alert-danger mb-3" role="alert">
                  {{ session('error') }}
                </div>
              @endif

              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </form>
          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('vuexy-layout/assets')}}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{asset('vuexy-layout/assets')}}/vendor/libs/popper/popper.js"></script>
    <script src="{{asset('vuexy-layout/assets')}}/vendor/js/bootstrap.js"></script>
    <script src="{{asset('vuexy-layout/assets')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{asset('vuexy-layout/assets')}}/vendor/libs/node-waves/node-waves.js"></script>

    <script src="{{asset('vuexy-layout/assets')}}/vendor/libs/hammer/hammer.js"></script>
    <script src="{{asset('vuexy-layout/assets')}}/vendor/libs/i18n/i18n.js"></script>
    <script src="{{asset('vuexy-layout/assets')}}/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="{{asset('vuexy-layout/assets')}}/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('vuexy-layout/assets')}}/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="{{asset('vuexy-layout/assets')}}/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="{{asset('vuexy-layout/assets')}}/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

    <!-- Main JS -->
    <script src="{{asset('vuexy-layout/assets')}}/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{asset('vuexy-layout/assets')}}/js/pages-auth.js"></script>
  </body>
</html>
