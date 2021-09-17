<template>
  <div>
    <heading class="mb-6">Publiceren</heading>

    <p class="mb-6">Publiceer de website om wijzigingen publiek te maken.</p>

    <button
      v-on:click="publish"
      :disabled="!!publishing"
      class="btn btn-default btn-primary mb-6"
    >
      Publiceer website
    </button>

    <p v-if="error" class="error text-error-message mb-6">
      Er is iets mis gegaan, neem contact op met GRRR. De foutmelding is: "{{
        error
      }}"
    </p>

    <p v-if="lastRun && lastRun.status === 'completed'">
      Website voor het laatst op
      {{ formatDate(lastRun.updated_at) }} gepubliceerd.
      <span v-if="lastRun.conclusion === 'failure'">
        Helaas is dit mis gegaan, neem contact op met GRRR.</span
      >
    </p>

    <p v-if="lastRun && lastRun.status !== 'completed'">
      Website publicatie gestart op {{ formatDate(lastRun.created_at) }}, een
      paar minuten geduld.
    </p>
  </div>
</template>

<script>
export default {
  metaInfo() {
    return {
      title: "Publiceer",
    };
  },
  mounted() {
    this.updateStatus();
    this.startStatusRefresh();
  },
  props: {
    publishing: false,
    lastRun: null,
    error: null,
  },
  methods: {
    publish() {
      axios
        .post("/nova-vendor/publish/publish")
        .then((response) => {
          this.publishing = true;
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
    updateStatus() {
      axios
        .get("/nova-vendor/publish/last-publish-run")
        .then((lastRun) => {
          this.lastRun = lastRun.data;
          this.publishing = lastRun.data.status !== "completed";
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
    startStatusRefresh() {
      window.setInterval(() => {
        this.updateStatus();
      }, 10000);
    },
    formatDate(date) {
      return new Intl.DateTimeFormat("nl-NL", {
        dateStyle: "full",
        timeStyle: "long",
      }).format(new Date(date));
    },
  },
};
</script>

<style>
/* Scoped Styles */
</style>
