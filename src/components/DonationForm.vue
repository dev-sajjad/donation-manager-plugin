<template>
  <el-form
    :model="donationForm"
    label-width="120px"
    @submit.native.prevent="submitForm"
  >
    <el-form-item label="Donor Name">
      <el-input
        v-model="donationForm.name"
        placeholder="Enter your name"
      ></el-input>
    </el-form-item>

    <el-form-item label="Donation Amount">
      <el-input
        v-model="donationForm.amount"
        placeholder="Enter donation amount"
      ></el-input>
    </el-form-item>

    <el-form-item label="Email">
      <el-input
        v-model="donationForm.email"
        placeholder="Enter your email"
      ></el-input>
    </el-form-item>

    <el-form-item label="Category">
      <el-select
        v-model="donationForm.category"
        placeholder="Select donation category"
      >
        <el-option label="General" value="general"></el-option>
        <el-option label="Charity" value="charity"></el-option>
        <el-option label="Education" value="education"></el-option>
      </el-select>
    </el-form-item>

    <el-form-item>
      <el-button type="primary" @click="submitForm">Submit Donation</el-button>
    </el-form-item>
  </el-form>
</template>

<script>
export default {
  data() {
    return {
      donationForm: {
        name: "",
        amount: "",
        email: "",
        category: "",
      },
    };
  },
  methods: {
    submitForm() {
      if (
        this.donationForm.name &&
        this.donationForm.amount &&
        this.donationForm.email
      ) {
        alert(
          `Thank you ${this.donationForm.name} for donating ${this.donationForm.amount} in ${this.donationForm.category} category!`
        );
      } else {
        this.$message.error("Please fill all the fields correctly!");
      }
    },
  },
};
</script>

<style scoped>
/* Custom styling */
.el-input {
  width: 100%;
}
.el-select {
  width: 100%;
}
</style>
