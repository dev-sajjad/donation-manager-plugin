<template>
  <el-table :data="donations" style="width: 100%">
    <el-table-column prop="name" label="Name"></el-table-column>
    <el-table-column prop="email" label="Email"></el-table-column>
    <el-table-column prop="amount" label="Amount"></el-table-column>
    <el-table-column prop="category" label="Category"></el-table-column>
  </el-table>
</template>

<script>
export default {
  data() {
    return {
      donations: [] 
    }
  },
  mounted() {
    
  }
}
</script>