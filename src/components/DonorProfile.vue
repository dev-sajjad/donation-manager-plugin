<template>
  <el-card class="donor-profile">
    <h2>{{ donor.name }}</h2>
    <p><strong>Email:</strong> {{ donor.email }}</p>
    <p><strong>Address:</strong> {{ donor.address }}</p>
    <p><strong>Total Donations:</strong> {{ donor.total_donations }}</p>
    <el-button type="primary" @click="exportProfile">Export as CSV</el-button>
  </el-card>
</template>

<script>
export default {
  props: {
    donor: Object
  },
  methods: {
    exportProfile() {
      // Export logic here
    }
  }
}
</script>

<style scoped>
.donor-profile {
  padding: 20px;
  margin: 10px;
}
</style>