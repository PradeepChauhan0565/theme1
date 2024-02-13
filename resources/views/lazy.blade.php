  @extends('layout')
  @section('content')
      <style>
          @property --progress-value {
              syntax: '<integer>';
              inherits: false;
              initial-value: 0;
          }

          @keyframes html-progress {
              to {
                  --progress-value: 92;
              }
          }

          @keyframes css-progress {
              to {
                  --progress-value: 87;
              }
          }

          @keyframes js-progress {
              to {
                  --progress-value: 73;
              }
          }

          .progress-bar {
              width: 100px;
              height: 100px;
              border-radius: 50%;

              /* to center the percentage value */
              display: flex;
              justify-content: center;
              align-items: center;
          }

          .progress-bar::before {
              counter-reset: percentage var(--progress-value);
              content: counter(percentage) '%';
          }

          .html {
              background:
                  radial-gradient(closest-side, white 79%, transparent 80% 100%),
                  conic-gradient(hotpink calc(var(--progress-value) * 1%), pink 0);
              animation: html-progress 2s 1 forwards;
          }

          .html::before {
              animation: html-progress 2s 1 forwards;
          }

          .css {
              background:
                  radial-gradient(closest-side, white 79%, transparent 80% 100%, white 0),
                  conic-gradient(hotpink calc(var(--progress-value) * 1%), pink 0);
              animation: css-progress 2s 1 forwards;
          }

          .css::before {
              animation: css-progress 2s 1 forwards;
          }

          .js {
              background:
                  radial-gradient(closest-side, white 79%, transparent 80% 100%, white 0),
                  conic-gradient(hotpink calc(var(--progress-value) * 1%), pink 0);
              animation: js-progress 2s 1 forwards;
          }

          .js::before {
              animation: js-progress 2s 1 forwards;
          }

          /* body {
                  font-family: -apple-system, system-ui, Helvetica, Arial, sans-serif;
                  margin: 30px auto;
                  display: flex;
                  justify-content: space-around;
                  align-items: center;
                  flex-wrap: wrap;
                  max-width: 600px;
              } */

          h2 {
              text-align: center;
          }

          progress {
              visibility: hidden;
              width: 0;
              height: 0;
          }
      </style>

      <div class="progress-bar-container">
          <h2>
              <label for="html">HTML</label>
          </h2>
          <div class="progress-bar html">
              <progress id="html" min="0" max="100" value="92"></progress>
          </div>
      </div>

      <div class="progress-bar-container">
          <h2>
              <label for="css">CSS</label>
          </h2>
          <div class="progress-bar css">
              <progress id="css" min="0" max="100" value="87"></progress>
          </div>
      </div>

      <div class="progress-bar-container">
          <h2>
              <label for="js">JavaScript</label>
          </h2>
          <div class="progress-bar js">
              <progress id="js" min="0" max="100" value="73"></progress>
          </div>
      </div>
  @endsection
