<template>
  <div>
    <Head title="Race Chat" />

    <iframe
      class="irc"
      frameBorder="0"
      src="https://widget.mibbit.com/?settings=fc2f995b2c9c6b9f0e26e3c95534ad42&server=irc2.speedrunslive.com&channel=%23speedrunslive&nick=&promptPass=&noServerTab=false"
    />
  </div>
</template>

<script>
export default {
  props: {
    users: Array,
  },
};
</script>
