<template>
  <div>
    <Head title="Publiceer een nieuwe website" />
    <heading class="mb-6">Publiceren</heading>

    <p class="mb-6">Publiceer de website om wijzigingen publiek te maken.</p>

    <default-button @click="publish" :disabled="!!publishing" class="mb-6">
      Publiceer website
    </default-button>

    <p v-if="error" class="error text-error-message mb-6">
      Er is iets mis gegaan, neem contact op met GRRR. De foutmelding is: "{{
        error
      }}"
    </p>

    <p v-if="lastRun && lastRun.status === 'completed'" class="mb-6">
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
  mounted() {
    this.updateStatus();
    this.startStatusRefresh();
  },
  props: {
    publishing: {
      type: Boolean,
      default: true,
    },
    lastRun: Object,
    error: String,
  },
  data() {
    return {
      error: "",
      publishing: false,
      lastRun: undefined,
    };
  },
  methods: {
    publish() {
      this.publishing = true;
      Nova.request()
        .post("/nova-vendor/publish/publish")
        .then((response) => {
          this.error = "";
        })
        .catch((error) => {
          this.error = error.message;
          this.publishing = false;
        });
    },
    updateStatus() {
      Nova.request()
        .get("/nova-vendor/publish/last-publish-run")
        .then((lastRun) => {
          console.log(lastRun.data);
          this.lastRun = lastRun.data;
          this.publishing = lastRun.data.status !== "completed";
          this.error = "";
        })
        .catch((error) => {
          this.error = error.message;
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
