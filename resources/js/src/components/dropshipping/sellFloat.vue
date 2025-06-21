<template>
  <div class="sellFloat">
      <div class="text-white ">
        Vender
      </div>
    </div>
</template>

<style lang="scss">
.sellFloat{
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  height: 6.5rem;
  width: 6.5rem;
  border: 0.5rem solid #85fb85;
  background: #19cd15;
  border-radius: 50%;
  bottom: 11%;
  right: 26%;
  z-index: 11;
  font-size: 1.1rem;
  animation: bounce-in 2s alternate-reverse infinite;
}
@media screen and (max-width: 780px){
  .sellFloat{
    right: 1rem;
  }
}

@keyframes bounce-in {
  0% {
    opacity: 1;
    transform: scale(0.9) translateY(-0.1rem);
  }
  50% {
    opacity: 1;
    transform: scale(1.05) translateY(-0.1rem);
  }
  70% { transform: scale(1) translateY(-0.1rem); }
  100% { transform: scale(1) translateY(-0.1rem); }
}
</style>