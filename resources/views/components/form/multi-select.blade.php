<div x-data="multiSelect()" class="flex-1 ml-8">
    <x-form.label name="Services"/>

    <select
        x-ref="select"
        :multiple="multiple"
        required></select>
    <input type="hidden" name="services" x-bind:value="value" required/>
</div>

<style>
    .choices{
        /*max-height: 40px;*/
    }
</style>

<script>
    function multiSelect() {
        return {
            multiple: true,
            value: @json($services ?? []),
            options: [],
            loadOptions() {
                axios.get('/api/services')
                    .then(res => {
                        this.options = res.data.data.map(function (option) {
                            return {
                                value: option.id,
                                label: option.name,
                            };
                        });
                    });
            },

            validate() {
                this.isValid = this.value.length > 0;
            },
            init() {
                this.loadOptions();

                this.$nextTick(() => {
                    let choices = new Choices(this.$refs.select, {
                        removeItemButton: true,
                        searchEnabled: false,

                    });

                    let refreshChoices = () => {
                        let selection = this.multiple ? this.value : [this.value];

                        choices.clearStore();
                        choices.setChoices(this.options.map(({value, label}) => ({
                            value,
                            label,
                            selected: selection.includes(value),
                        })));
                    };

                    refreshChoices();

                    this.$refs.select.addEventListener('change', () => {
                        this.value = choices.getValue(true);
                    });

                    this.$watch('value', () => refreshChoices());
                    this.$watch('options', () => refreshChoices());
                });
            }
        }
    }

</script>
