<template>
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="d-flex"></div>
        </div>
        <div class="d-flex justify-content-between align-items-end flex-wrap">
          <button @click="create()" class="btn btn-primary mt-2 mt-xl-0" v-if="index">Add Plan</button>
          <button @click="back()" class="btn btn-primary mt-2 mt-xl-0" v-if="!index">Back</button>
        </div>
      </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card" v-if="index">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table aria-describedby="Ads Table" class="table">
              <thead>
                <tr>
        
                  <th class="text-center" id="title">Title</th>
                  <th class="text-center" id="ads link">Price</th>
                  <th class="text-center" id="options">Options</th>
                </tr>
              </thead>
              <tbody>
                <tr :key="index" v-for="(plan, index) in paginated('filteredPlans')">

                  <td class="text-center">{{plan.title}}</td>
                  <td class="text-center">{{plan.price}}</td>
                  <td class="text-center">
                    <div class="list-icons">
                      <a
                        @click="editing(plan)"
                        class="list-icons-item mr-2"
                        data-original-title="Edit"
                        rel="tooltip"
                        title
                      >
                        <em class="mdi mdi-pencil fa-lg" style="color:#4d83ff"></em>
                      </a>
                      <a
                        @click="destroy(plan.id, index)"
                        class="list-icons-item text-warning"
                        data-original-title="Delete"
                        rel="tooltip"
                        title
                      >
                        <em class="mdi mdi-delete fa-lg" style="color:red"></em>
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>

              <paginate
                :list="filteredPlans"
                :per="5"
                name="filteredPlans"
                tag="tbody"
                v-if="filteredPlans.length"
              ></paginate>

              <paginate-links
                :async="true"
                :classes="{
                                    'ul': 'pagination',
                                    'li': 'page-item',
                                    'a': 'page-link',
                                    '.next > a': 'next-link',
                                    '.prev > a': 'prev-link'}"
                :hide-single-page="true"
                :limit="5"
                :show-step-links="true"
                class="float-right"
                for="filteredPlans"
                v-if="filteredPlans.length"
              ></paginate-links>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 grid-margin stretch-card" v-if="add || edit">
      <div class="card">
        <div class="card-body">
          <form class="forms-sample">
            <div class="form-group">
              <label for="name">Title</label>
              <input
                class="form-control"
                id="title"
                placeholder="Title"
                type="text"
                v-model="form.plan.title"
              />
            </div>

            <div class="form-group">
              <label for="name">Price</label>
              <input
                class="form-control"
                id="price"
                placeholder="Plan Price"
                type="text"
                v-model="form.plan.price"
              />
            </div>

            <button
              @click.prevent="store()"
              class="btn btn-primary mr-2"
              type="submit"
              v-if="add"
            >Save</button>
            <button
              @click.prevent="update()"
              class="btn btn-primary mr-2"
              type="submit"
              v-if="edit"
            >Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { notifications } from "../mixins/notifications";

export default {
  data() {
    return {
      index: true,
      add: false,
      edit: false,
      search: "",
      form: {
        plan: {
          title: "",
          price: null,
        },
      },
      plans: [],
      paginate: ["filteredPlans"],
    };
  },
  async mounted() {
    const response = await axios.get(url + "/admin/plans/data");
    this.plans = response.data;
  },

  methods: {
    create() {
      this.index = false;
      this.edit = false;
      this.add = true;
    
    },

    editing(plan) {
      this.index = false;
      this.edit = true;
      this.form.plan = plan;
      this.form.plans = "";
    },

    back() {
      this.form.plan = "";
      this.add = false;
      this.edit = false;
      this.index = true;
    },

    store() {
      axios
        .post(url + "/admin/plans/store", this.form)
        .then((response) => {
          this.add = false;
          this.edit = false;
          this.index = true;
          this.form.plan = {};
          this.plans.unshift(response.data.body);
          this.showSuccess(response.data.message);
        })
        .catch((error) => {
          this.showError(error.response);
        });
    },

    update() {
      axios
        .put(url + "/admin/plans/update/" + this.form.plan.id, this.form)
        .then((response) => {
          this.edit = false;
          this.index = true;
          this.form.plans = [];
          this.showSuccess(response.data.message);
        })
        .catch((error) => {
          this.showError(error.response);
        });
    },

    // delete a record (user) in the database
    destroy(id, index) {
      this.showConfirm(async () => {
        try {
          const response = await axios.delete(url + "/admin/plans/destroy/" + id);
          const planIndex = this.plans.findIndex((plan) => plan.id === id);
          this.allads.splice(planIndex, 1);
          this.paginate.filteredPlans.list.splice(index, 1);
          this.showSuccess(response.data.message);
        } catch (error) {
          this.showError();
        }
      });
    },
  },
  computed: {
    // filter the movies array with the search matches and return the filtered array
    filteredPlans() {
      return this.plans.filter((plan) => {
        return plan.title.toLowerCase().match(this.search.toLowerCase());
      });
    },
  },

  mixins: [notifications],
};
</script>