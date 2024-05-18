<template>
  <span>
   <HomePart1/>
    <PlanMenu/>
  </span>

</template>

<script>
import HomePart1 from "@/components/HomePart1";
import PlanMenu from "@/components/PlanMenu";
export default {
  name: "Home",
  components : {
    HomePart1,PlanMenu
  }
};
</script>

<style scoped>
.home-hero {
  background: url('http://source.unsplash.com/0BhSKStVtdM');
  background-size: cover;
  width: 100%;
  height: 100%;
}
</style>