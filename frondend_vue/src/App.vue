<template>
  <div id="app">
    <nav>
      <router-link
        to="/"
        @mouseover="hideSquares"
        @mouseleave="showSquares"
      >
        Home
      </router-link>
      |
      <router-link
        to="/about"
        @mouseover="hideSquares"
        @mouseleave="showSquares"
      >
        About
      </router-link>
    </nav>
    <router-view />
    <div v-if="showFollower">
      <div id="follower" :style="followerStyle"></div>
      <div
        v-for="(style, index) in surroundingStyles"
        :key="index"
        class="follower-extra"
        :style="style"
      ></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      mouseX: 0,
      mouseY: 0,
      offset: 50,
      gridSize: 5,
      showFollower: true,
      blinkIntervals: [],
    };
  },
  computed: {
    followerStyle() {
      return {
        top: this.mouseY + "px",
        left: this.mouseX + "px",
      };
    },
    surroundingStyles() {
      const offset = this.offset;
      const positions = [];
      const gridCenter = Math.floor(this.gridSize / 2);

      for (let row = 0; row < this.gridSize; row++) {
        for (let col = 0; col < this.gridSize; col++) {
          if (row === gridCenter && col === gridCenter) continue; 
          positions.push({
            top: this.mouseY + (row - gridCenter) * offset + "px",
            left: this.mouseX + (col - gridCenter) * offset + "px",
          });
        }
      }

      return positions;
    },
  },
  watch: {
    showFollower(newValue) {
      if (newValue) {
        this.startBlinking();
      } else {
        this.stopBlinking();
      }
    },
  },
  mounted() {
    window.addEventListener("mousemove", this.updateMousePosition);
    this.startBlinking();
  },
  beforeUnmount() {
    window.removeEventListener("mousemove", this.updateMousePosition);
    this.stopBlinking();
  },
  methods: {
    updateMousePosition(event) {
      this.mouseX = event.clientX;
      this.mouseY = event.clientY;
    },
    hideSquares() {
      this.showFollower = false;
    },
    showSquares() {
      this.showFollower = true;
    },
    startBlinking() {
      this.stopBlinking(); 
      this.surroundingStyles.forEach((_, index) => {
        const interval = setInterval(() => {
          const elements = document.querySelectorAll(".follower-extra");
          if (elements[index]) {
            elements[index].style.opacity = Math.random() > 0.5 ? "1" : "0";
          }
        }, Math.random() * 800 + 200); 
        this.blinkIntervals.push(interval);
      });
    },
    stopBlinking() {
      this.blinkIntervals.forEach((interval) => clearInterval(interval));
      this.blinkIntervals = [];
    },
  },
};
</script>


<style>
body {
  margin: 0;
  background-color: #1a1a2e;
  color: #fff;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  text-align: center;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #fff;
  text-decoration: none;
}

nav a.router-link-exact-active {
  color: #42b983;
}

#follower {
  position: fixed;
  width: 25px;
  height: 25px;
  background-color: none;
  pointer-events: none;
  border-radius: 5px;
  transform: translate(-50%, -50%);
  transition: opacity 0.5s ease-in-out;
}

.follower-extra {
  position: fixed;
  width: 40px;
  height: 40px;
  background-color: #42b983;
  pointer-events: none;
  border-radius: 5px;
  transform: translate(-50%, -50%);
  opacity: 1;
  box-shadow: 0 0 10px 3px #42b983;
  transition: opacity 0.5s ease-in-out;
  overflow: hidden; /* Nécessaire pour contenir les bandes roses */
}

.follower-extra::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: repeating-linear-gradient(
    45deg,
    transparent,
    transparent 3px,
    #ff0099 3px,
    #ff0099 6px
  ); /* Bandes roses diagonales */
  animation: glitch 1s infinite linear; /* Animation pour simuler les parasites */
  opacity: 0.8; /* Légèrement transparent */
}

/* Animation pour simuler des parasites */
@keyframes glitch {
  0% {
    transform: translate(0, 0);
  }
  25% {
    transform: translate(2px, -2px);
  }
  50% {
    transform: translate(-2px, 2px);
  }
  75% {
    transform: translate(1px, -1px);
  }
  100% {
    transform: translate(0, 0);
  }
}

.hidden #follower,
.hidden .follower-extra {
  opacity: 0;
  visibility: hidden;
}
</style>

