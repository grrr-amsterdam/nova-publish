<template>
  <Head :title="__('title')" />
  <heading class="mb-6">{{ __("heading") }}</heading>

  <p class="mb-6">{{ __("explanation") }}</p>

  <default-button @click="publish" :disabled="!!publishing" class="mb-6">
    {{ __("button_text") }}
  </default-button>

  <p v-if="error" class="error text-error-message mb-6">
    {{ __("error", error) }}
  </p>

  <p v-if="lastRun && lastRun.status === 'completed'" class="mb-6">
    {{ __("completed_message", { last_run: formatDate(lastRun.updated_at) }) }}
    <span v-if="lastRun.conclusion === 'failure'">
      {{ __("error_short") }}</span
    >
  </p>

  <p v-if="lastRun && lastRun.status !== 'completed'">
    {{ __("running_message", { last_run: formatDate(lastRun.created_at) }) }}
  </p>
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
      return new Intl.DateTimeFormat(Nova.config("locale"), {
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
