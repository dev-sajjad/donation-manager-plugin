<template>
  <el-table :data="topDonors" style="width: 100%">
    <el-table-column prop="name" label="Name"></el-table-column>
    <el-table-column prop="total_donations" label="Total Donations"></el-table-column>
  </el-table>
</template>

<script>
export default {
  data() {
    return {
      topDonors: [] // Fetch from API
    }
  },
  mounted() {
    // Fetch top donors from backend
  }
}
</script>