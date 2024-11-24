<template>
  <div>
    <Head title="Race Chat" />

    <iframe
      src="https://kiwiirc.com/nextclient/irc.speedrunslive.com/#speedrunslive"
      style="border:0; width:100%; height:700px;"
    ></iframe>
  </div>
</template>

<script>
export default {
  props: {
    users: Array,
  },
};
</script>
