<template>
  <div class="modal text-white" role="modal" :class="getClasses(color, dismissible)">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button v-if="dismissible" type="button" class="btn-close d-flex justify-content-center align-items-center"
            data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-lg font-weight-bold">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <slot />
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MaterialModal",
  props: {
    color: {
      type: String,
      default: "success",
    },
    icon: {
      type: String,
      default: "",
    },
    dismissible: {
      type: Boolean,
      default: false,
    },
    show: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    getClasses: (color, dismissible) => {
      let colorValue, dismissibleValue;

      colorValue = color ? `modal-${color}` : null;

      dismissibleValue = dismissible ? "modal-dismissible fade show" : null;

      return `${colorValue} ${dismissibleValue}`;
    },
    getIcon: (icon) => (icon ? icon : null),
  },
};
</script>
