<template>
  <el-container>
    <el-header>
      <el-menu :router="true" mode="horizontal">
        <el-menu-item index="/">Pacientes</el-menu-item>
        <el-menu-item index="/appointments">Consultas</el-menu-item>
      </el-menu>
    </el-header>
    <el-main>
      <router-view />
    </el-main>
  </el-container>
</template>

<script>
export default {
  name: 'App',
}
</script>
