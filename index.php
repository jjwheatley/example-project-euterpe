<!DOCTYPE HTML>
<html lang="en">
  <head>
    <!--<script type="text/javascript" src="/assets/jquery-3.2.1.js"></script>-->
    <style type="text/css">
        body{
            background-color: #eee;
        }
        table.dataTable.no-footer {
            border-bottom: none;
        }
    </style>
  </head>
  <body onkeydown="keyDown(event)" onkeyup="keyUp(event)">
    <button onClick="SetSoundMap(0)">Modal Mode</button>
    <button onClick="SetSoundMap(1)">Circle of 5th Mode</button>
    <button onClick="SetSoundMap(2)">Chromatic Mode</button>
    <?php $sharps = array('C','D','F','G','A',); ?>
    <?php foreach(range('A', 'G') as $letter): ?>
        <audio id="<?php echo $letter.'-Note'; ?>">
            <source src="/sounds/<?php echo $letter.'-Note.mp3'; ?>" type="audio/mpeg">
            <!-- Your browser does not support the audio element. -->
        </audio>
        <audio id="<?php echo $letter.'-Maj'; ?>">
            <source src="/sounds/<?php echo $letter.'-Maj.mp3'; ?>" type="audio/mpeg">
            <!-- Your browser does not support the audio element. -->
        </audio>
        <audio id="<?php echo $letter.'-Min'; ?>">
            <source src="/sounds/<?php echo $letter.'-Min.mp3'; ?>" type="audio/mpeg">
            <!-- Your browser does not support the audio element. -->
        </audio>
        <?php if (in_array($letter, $sharps)): ?>
            <?php //var_dump($letter.'#-Note'); ?>
            <audio id="<?php echo $letter.'#-Note'; ?>">
                <source src="/sounds/<?php echo $letter.'-Sharp-Note.mp3'; ?>" type="audio/mpeg">
                <!-- Your browser does not support the audio element. -->
            </audio>
            <audio id="<?php echo $letter.'#-Maj'; ?>">
                <source src="/sounds/<?php echo $letter.'-Sharp-Maj.mp3'; ?>" type="audio/mpeg">
                <!-- Your browser does not support the audio element. -->
            </audio>
            <audio id="<?php echo $letter.'#-Min'; ?>">
                <source src="/sounds/<?php echo $letter.'-Sharp-Min.mp3'; ?>" type="audio/mpeg">
                <!-- Your browser does not support the audio element. -->
            </audio>
        <?php endif; ?>
    <?php endforeach; ?>
    <!-- <embed type="audio/x-wav" src="/sounds/A-Note.wav" width="0" height="0" id="A-Note" enablejavascript="true"> -->

    <div style="padding: 20px;">
    </div>
  </body>
</html>

<script>
    var SoundMapID = 0;
    function SetSoundMap(setting){
        SoundMapID = setting;
    }

    var KeyToSound2 = function (propertyName) {
        if (SoundMapID == 0) {
            return soundMap0[propertyName];
        } else if (SoundMapID == 1) {
            console.log(soundMap1[propertyName]);
            return soundMap1[propertyName];
        } else if (SoundMapID == 2) {
            return soundMap2[propertyName];
        }
        // var soundSet =
    };
    //Define Array to store pressed keys
    var pressed = [];
    function PlaySound(soundObj) {
      var sound = document.getElementById(soundObj);
      //Reset Sound, with each keypress
      sound.pause();
      sound.currentTime = 0;
      sound.play();
    }

    function keyDown(event) {
        var x = event.which;
        console.log(x);
         // || event.keyCode;
        if(pressed.indexOf(x) == -1) {
            var file = KeyToSound2(getKeyCode(x));
            // var file = keyToSound(x)
            if (file){
              // console.log(file);
              PlaySound(file);
            }
            pressed.push(x);
        }
    }

    function keyUp(event) {
        var x = event.which;
        // || event.keyCode;
        pressed = pressed.splice(x, 1);
    }

    var getKeyCode = function (propertyName) {
        return keyCodeList[propertyName];
    };
    //Modal
    var soundMap0 = {
        "q" : "A-Note",
        "w" : "B-Note",
        "e" : "C-Note",
        "r" : "D-Note",
        "t" : "E-Note",
        "y" : "F-Note",
        "u" : "G-Note",
        "a" : "A-Maj",
        "s" : "B-Maj",
        "d" : "C-Maj",
        "f" : "D-Maj",
        "g" : "E-Maj",
        "h" : "F-Maj",
        "j" : "G-Maj",
        "z" : "A-Min",
        "x" : "B-Min",
        "c" : "C-Min",
        "v" : "D-Min",
        "b" : "E-Min",
        "n" : "F-Min",
        "m" : "G-Min",
    };
    //Circle of 5ths
    var soundMap1 = {
        "q" : "A-Note",
        "w" : "E-Note",
        "e" : "B-Note",
        "r" : "F#-Note",
        "t" : "C#-Note",
        "y" : "G#-Note",
        "u" : "D#-Note",
        "i" : "A#-Note",
        "o" : "F-Note",
        "p" : "C-Note",
        "[" : "G-Note",
        "]" : "D-Note",
        "a" : "A-Maj",
        "s" : "E-Maj",
        "d" : "B-Maj",
        "f" : "F#-Maj",
        "g" : "C#-Maj",
        "h" : "G#-Maj",
        "j" : "D#-Maj",
        "k" : "A#-Maj",
        "l" : "F-Maj",
        ";" : "C-Maj",
        "'" : "G-Maj",
        "#" : "D-Maj",
    };
    //Chromatic
    var soundMap2 = {
        "q" : "A-Note",
        "w" : "A#-Note",
        "e" : "B-Note",
        "r" : "C-Note",
        "t" : "C#-Note",
        "y" : "D-Note",
        "u" : "D#-Note",
        "i" : "E-Note",
        "o" : "F-Note",
        "p" : "F#-Note",
        "[" : "G-Note",
        "]" : "G#-Note",
        "a" : "A-Maj",
        "s" : "A#-Maj",
        "d" : "B-Maj",
        "f" : "C-Maj",
        "g" : "C#-Maj",
        "h" : "D-Maj",
        "j" : "D#-Maj",
        "k" : "E-Maj",
        "l" : "F-Maj",
        ";" : "F#-Maj",
        "'" : "G-Maj",
        "#" : "G#-Maj",
    };
    //e.which code to Key Mapping
    var keyCodeList = {
      48 : "0",
      49 : "1",
      50 : "2",
      51 : "3",
      52 : "4",
      53 : "5",
      54 : "6",
      55 : "7",
      56 : "8",
      57 : "9",
      65 : "a",
      66 : "b",
      67 : "c",
      68 : "d",
      69 : "e",
      70 : "f",
      71 : "g",
      72 : "h",
      73 : "i",
      74 : "j",
      75 : "k",
      76 : "l",
      77 : "m",
      78 : "n",
      79 : "o",
      80 : "p",
      81 : "q",
      82 : "r",
      83 : "s",
      84 : "t",
      85 : "u",
      86 : "v",
      87 : "w",
      88 : "x",
      89 : "y",
      90 : "z",
      186 : ";",
      192 : "'",
      219 : "[",
      221 : "]",
      222 : "#",
    };
</script>