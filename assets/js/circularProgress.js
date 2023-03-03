let progressBar = document.querySelector('.circular-progress');
let valueContainer = document.querySelector('.value-container');

let progressValue = 0;
let progressEndValue = valueContainer.innerHTML;
let speed = 0;

let progress = setInterval(()=>{
	progressValue++;
	valueContainer.textContent = `${progressValue}%`;
	progressBar.style.background = `conic-gradient(
		#344F21 ${progressValue * 3.6}deg,
		#d3d3d3 ${progressValue * 3.6}deg
	)`;
	if(progressValue == progressEndValue){
		clearInterval(progress);
	}
});