import Vue from "vue";
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import DonationForm from "./components/DonationForm.vue";

Vue.use(ElementUI);

new Vue({
  el: "#donation-app",
  render: (h) => h(DonationForm), // Render the DonationForm component
});
