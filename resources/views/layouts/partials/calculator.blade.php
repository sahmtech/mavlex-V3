

<style> 
#calculator button {
margin-left: 10px !important;
}
</style>
    <div id="calculator">
    <div class="row text-center" id="calc">
    <div class="calcBG col-md-12 text-center">
      <div class="row" id="result">
        <form name="calc">
          <input type="text" class="screen text-right" name="result" readonly>
        </form>
      </div>

        <table class="buttons">
            <tr>
                <td><button id="allClear" type="button" class="btn btn-clear"  onclick="clearScreen()">AC</button></td>
                <td><button id="clear" type="button" class="btn btn-clear"  onclick="clearScreen()">CE</button></td>
                <td><button id="%" type="button"class="btn btn-operator"  onclick="calEnterVal(this.id)">%</button></td>
                <td><button id="/" type="button"class="btn btn-operator"  onclick="calEnterVal(this.id)">÷</button></td>
            </tr>
            <tr>
                <td><button id="7" type="button"class="btn btn-number" onclick="calEnterVal(this.id)">7</button></td>
                <td><button id="8" type="button"class="btn btn-number" onclick="calEnterVal(this.id)">8</button></td>
                <td><button id="9" type="button"class="btn btn-number" onclick="calEnterVal(this.id)">9</button></td>
                <td><button id="*" type="button"class="btn btn-operator"  onclick="calEnterVal(this.id)">x</button></td>
            </tr>
            <tr>
                <td><button id="4" type="button"class="btn btn-number" onclick="calEnterVal(this.id)">4</button></td>
                <td><button id="5" type="button"class="btn btn-number" onclick="calEnterVal(this.id)">5</button></td>
                <td><button id="6" type="button"class="btn btn-number" onclick="calEnterVal(this.id)">6</button></td>
                <td><button id="-" type="button"class="btn btn-operator"  onclick="calEnterVal(this.id)">-</button></td>
            </tr>
            <tr>
                <td><button id="1" type="button"class="btn btn-number" onclick="calEnterVal(this.id)">1</button></td>
                <td><button id="2" type="button"class="btn btn-number" onclick="calEnterVal(this.id)">2</button></td>
                <td><button id="3" type="button"class="btn btn-number" onclick="calEnterVal(this.id)">3</button></td>
                <td><button id="+" type="button"class="btn btn-operator"  onclick="calEnterVal(this.id)">+</button></td>
            </tr>
            <tr>
                <td colspan="2"><button id="0" type="button"class="btn btn-number" onclick="calEnterVal(this.id)">0</button></td>
                <td><button id="." type="button"class="btn btn-decimal"onclick="calEnterVal(this.id)">.</button></td>
                <td><button id="equals" type="button"  class="btn btn-equals" onclick="calculate()">=</button></td>
            </tr>
        </table>
   
    </div>
    </div>
    </div>

    