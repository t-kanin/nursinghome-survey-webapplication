 <div class="birthdate">
        <label>Verjaardag</label>
        <SELECT id="day"  name="dd">
        </SELECT>
        <SELECT id="month"  name="mm" onchange="change_month(this)">
        </SELECT>
        <SELECT id="year" name="yyyy" onchange="change_year(this)">
        </SELECT>
    </div>
    <select value="language" name="language"  id="language" style="min-width:100%">
        <option value="Dutch">Nederlands</option>
        <option value="French">Français</option>
        <option value="English">English</option>
    </select>
    <div>
        <label>Geslacht</label>
        <input type="radio" name="Gender" value="Man"> <i class="fa fa-mars" aria-hidden="true"></i>
        <input type="radio" name="Gender" value="Vrouw"> <i class="fa fa-venus " aria-hidden="true"></i><br>
    </div>
    <div class="form-group pull-right">
        <button type="submit" id="register" class="btn-register">Maak Account</button>
    </div>
    <?php echo form_close(); ?>
</article>
</div>

