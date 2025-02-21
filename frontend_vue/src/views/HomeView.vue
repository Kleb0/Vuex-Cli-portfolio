<template>
  <div class="home">
    <div class="circle">
      <h1 class ="title">My portfolio</h1>
    </div>
  
  </div>
</template>

<script>
export default {
  name: 'HomeView',
  mounted() {
    this.rotateText();

  },
  methods: {
    rotateText(){
      const title = document.querySelector('.title');
      const radius = 340;
      let angle = 0;

      const updatePosition = () => {
        angle += 0.2;
        const x = radius * Math.cos(angle * Math.PI / 180);
        const y = radius * Math.sin(angle * Math.PI / 180);
        title.style.transform = `translate(${x}px, ${y}px) rotate(${0}deg)`;
        requestAnimationFrame(updatePosition);
      };
    
    updatePosition();
    }
  }
}

</script>

<style scoped>

.home {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  position: relative;
}

.circle {
  width: 680px;
  height: 680px;
  border: 2px solid #000000;
  background-color: transparent;
  border-radius: 50%;
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
}



.title {
  font-size: 4em;
  color: #000000;
  position: absolute;
  border: 2px solid #000000;
  border-radius: 20px;
  padding: 40px;
  transform: translateY(100%);
}



</style>
