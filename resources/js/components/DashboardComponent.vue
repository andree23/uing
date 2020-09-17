<template>
  <div class="content-wrapper">

     <div class="row">

      <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header alpha-success text-success-800 d-flex justify-content-between">
        <span class="font-weight-semibold">Welcome Admin!</span>
        <div class="d-flex justify-content-between">
          <div class="list-icons">
            <a href="#" class="list-icons-item" ></a>
          </div>
        </div>
      </div>
      <div class="card-body alpha-success">
        <div class="row">
          <div class="col-md-4">
            <h6 class="mb-2">
              <strong>Make it your own</strong>
            </h6>
            <a
              href="/public/admin/settings"
              class="btn btn-large btn-success bg-success mb-2 legitRipple"
            >
              <i class="mi-format-paint"></i> Customize the App
            </a>
            <p>
              <a href="/public/admin/settings" class="text-grey-800">Change your site’s title</a> or
              <a href="/public/admin/settings" class="text-grey-800">upload your logo</a>
            </p>
          </div>
          <div class="col-md-4">
            <h6 class="mb-2">Publish content</h6>
            <ul class="list-unstyled">
              <li class="mb-1">
                <i class="icon-play3 text-grey-300"></i>
                <a
                  href="/public/admin/movies"
                  class="ml-1 text-grey-800"
                >Add your first Movie</a>
              </li>
              <li class="mb-1">
                <i class="icon-magazine text-grey-300"></i>
                <a href="/public/admin/series" class="ml-1 text-grey-800">Write your first Serie</a>
              </li>
              <li class="mb-1">
                <i class="icon-files-empty text-grey-300"></i>
                <a href="/public/admin/streaming" class="ml-1 text-grey-800">Create your Stream</a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h6 class="mb-2">More actions</h6>
            <ul class="list-unstyled">
              <li class="mb-1">
                <i class="icon-users text-grey-300"></i>
                <a href="/public/admin/account" class="ml-1 text-grey-800">Customize your profile</a>
              </li>
              <li class="mb-1">
                <i class="icon-film text-grey-300"></i>
                <a href="/public/admin/ads" class="ml-1 text-grey-800">Create some pre-roll ads</a>
              </li>
              <li class="mb-1">
                <i class="icon-cogs text-grey-300"></i>
                <a href="/public/admin/settings" class="ml-1 text-grey-800">Update existing settings</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
      </div>
          </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body dashboard-tabs p-0">
            <div class="tab-content py-0 px-0">
              <div
                aria-labelledby="overview-tab"
                class="tab-pane fade active show"
                id="overview"
                role="tabpanel"
              >
                <div class="d-flex flex-wrap justify-content-xl-between">
                  <div
                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item"
                  >
                    <em class="fas fa-film text-danger icon-lg text-danger"></em>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Total Movies</small>
                      <h5 class="mr-2 mb-0">{{movies.length}}</h5>
                    </div>
                  </div>
                  <div
                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item"
                  >
                    <em class="fas fa-tv icon-lg text-success"></em>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Total Series</small>
                      <h5 class="mr-2 mb-0">{{series.length}}</h5>
                    </div>
                  </div>
                  <div
                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item"
                  >
                    <em class="mdi mdi-access-point menu-icon icon-lg text-warning"></em>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Total LIVE TV</small>
                      <h5 class="mr-2 mb-0">{{livetvs.length}}</h5>
                    </div>
                  </div>
                  <div
                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item"
                  >
                    <em class="mdi mdi-flag mr-3 icon-lg text-danger"></em>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Total Users</small>
                      <h5 class="mr-2 mb-0">{{users.length}}</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      movies: [],
      series: [],
      livetvs: [],
      users: [],
    };
  },
  async mounted() {
    let response = await axios.get(url + "/admin/movies/data");
    this.movies = response.data;

    response = await axios.get(url + "/admin/series/data");
    this.series = response.data;

    response = await axios.get(url + "/admin/livetv/data");
    this.livetvs = response.data;

    response = await axios.get(url + "/admin/users/allusers");
    this.users = response.data;
  },
  computed: {
    topmovies() {
      return _.orderBy(this.movies, "views").reverse().splice(0, 10);
    },
    topseries() {
      return _.orderBy(this.series, "views").reverse().splice(0, 10);
    },
    toplivetvs() {
      return _.orderBy(this.livetvs, "views").reverse().splice(0, 10);
    },

    topusers() {
      return _.orderBy(this.users, "id").reverse().splice(0, 10);
    },
  },
};
</script>
