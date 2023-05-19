<div class="property_filter">
    <p>Property filter</p>
<form class="property_filter_form">
    <div class="form__field">
        <div class="field_name">Name house:</div>
        <input class="property_filter_input name_house" name="name_house"></div>
    <div class="form__field">
        <div class="field_name">Location coordinates:</div>
        <input class="property_filter_input location_coordinates" name="location_coordinates"></div>
    <div class="form__field">
        <div class="field_name">Number of floors:</div>
        <select name="floor" class="property_filter_select">
            <option value="">-</option>
            <?php
            foreach ($floors as $floor) {
                echo '<option value="' . $floor . '">' . $floor . '</option>';
            }
            ?>
        </select></div>
    <div class="form__field">
        <div class="btn property_filter_submit">Search</div>
    </div>
</form>
</div>
