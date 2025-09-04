
function initPdfCanvas(url) {
  pageNumber = 1;
  if (url=='') {
     document.getElementById('pdf-canvas').style.display = 'none';
  } else {
      let pdfDoc = null;
      let currentScale = 1.5;
      const canvas = document.getElementById('pdf-canvas');
      const context = canvas.getContext('2d');
      const container = document.querySelector('.canvas-container');

      let fixedContainerHeight = null;
      let renderTask = null;

      let isDragging = false;
      let dragStartX, dragStartY;
      let translateX = 0,
        translateY = 0;

      function updateTransform() {
        canvas.style.transform = `translate(calc(-50% + ${translateX}px), calc(-50% + ${translateY}px)) scale(1)`;
      }

      const renderPage = (scale) => {
        pdfDoc.getPage(pageNumber).then(page => {
          const viewport = page.getViewport({
            scale
          });

          canvas.height = viewport.height;
          canvas.width = viewport.width;

          if (fixedContainerHeight === null) {
            fixedContainerHeight = viewport.height;
            container.style.height = fixedContainerHeight + 'px';
          }

          const renderContext = {
            canvasContext: context,
            viewport: viewport
          };

          // 前の描画が進行中ならキャンセル
          if (renderTask) {
            renderTask.cancel();
          }

          renderTask = page.render(renderContext);

          renderTask.promise.then(() => {
            renderTask = null; // 完了後にnullクリア
          }).catch((error) => {
            if (error?.name === 'RenderingCancelledException') {
              // キャンセルされた場合は無視
              return;
            }
            console.error('Render error:', error);
          });
        });
      };


      pdfjsLib.getDocument(url).promise.then(pdf => {
        pdfDoc = pdf;
        pdf.getPage(pageNumber).then(page => {
          const containerWidth = container.clientWidth;
          const viewport = page.getViewport({
            scale: 1
          });
          currentScale = containerWidth / viewport.width;
          renderPage(currentScale);
        });
      });

      function zoomIn() {
        currentScale = Math.min(currentScale + 0.2, 5);
        renderPage(currentScale);
      }

      function zoomOut() {
        currentScale = Math.max(currentScale - 0.2, 0.2);
        renderPage(currentScale);
      }

      function toggleFullscreen() {
        const elem = document.querySelector('.canvas-container');

        if (!document.fullscreenElement) {
          if (elem.requestFullscreen) {
            elem.requestFullscreen();
          } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
          } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
          }
        } else {
          if (document.exitFullscreen) {
            document.exitFullscreen();
          } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
          } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
          }
        }
      }

      canvas.addEventListener('mousedown', e => {
        isDragging = true;
        dragStartX = e.clientX - translateX;
        dragStartY = e.clientY - translateY;
        canvas.style.cursor = 'grabbing';
      });

      window.addEventListener('mouseup', () => {
        isDragging = false;
        canvas.style.cursor = 'grab';
      });

      window.addEventListener('mousemove', e => {
        if (!isDragging) return;
        translateX = e.clientX - dragStartX;
        translateY = e.clientY - dragStartY;
        updateTransform();
      });

      canvas.addEventListener('touchstart', e => {
        if (e.touches.length === 1) {
          isDragging = true;
          dragStartX = e.touches[0].clientX - translateX;
          dragStartY = e.touches[0].clientY - translateY;
        }
      });

      window.addEventListener('touchend', () => {
        isDragging = false;
      });

      window.addEventListener('touchmove', e => {
        if (!isDragging || e.touches.length !== 1) return;
        translateX = e.touches[0].clientX - dragStartX;
        translateY = e.touches[0].clientY - dragStartY;
        updateTransform();
        e.preventDefault();
      }, {
        passive: false
      });


      let initialPinchDistance = null;
      let initialScale = currentScale;

      canvas.addEventListener('touchstart', e => {
        if (e.touches.length === 2) {
          const dx = e.touches[0].clientX - e.touches[1].clientX;
          const dy = e.touches[0].clientY - e.touches[1].clientY;
          initialPinchDistance = Math.hypot(dx, dy);
          initialScale = currentScale;
        }
      }, {
        passive: false
      });

      canvas.addEventListener('touchmove', e => {
        if (e.touches.length === 2 && initialPinchDistance) {
          e.preventDefault();

          const dx = e.touches[0].clientX - e.touches[1].clientX;
          const dy = e.touches[0].clientY - e.touches[1].clientY;
          const currentDistance = Math.hypot(dx, dy);
          const scaleRatio = currentDistance / initialPinchDistance;
          currentScale = Math.min(Math.max(initialScale * scaleRatio, 0.2), 5); // 限界チェック

          renderPage(currentScale);
        }
      }, {
        passive: false
      });

      canvas.addEventListener('touchend', e => {
        if (e.touches.length < 2) {
          initialPinchDistance = null;
        }
      });




      container.addEventListener('wheel', (event) => {
        event.preventDefault();
        const delta = event.deltaY;
        if (delta < 0) {
          currentScale = Math.min(currentScale + 0.1, 5);
        } else {
          currentScale = Math.max(currentScale - 0.1, 0.2);
        }
        renderPage(currentScale);
      });
  }
}
