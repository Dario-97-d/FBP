
document.addEventListener('click', (e) => {
  if (!e.target.closest('.nav-button')) {
    document.querySelectorAll('.nav-dropup').forEach(div => div.classList.remove('open'));
    document.querySelectorAll('.nav-button').forEach(button => button.classList.remove('selected'));
  }
});

document.querySelectorAll('.nav-button').forEach(button => {
  button.addEventListener('click', () => {
    const targetId = button.dataset.name;
    const targetDiv = document.getElementById(targetId);

    // Close all other open divs.
    document.querySelectorAll('.nav-dropup').forEach(div => {
      if (div.id !== targetId) div.classList.remove('open');
    });

    document.querySelectorAll('.nav-button').forEach(button => {
      if (button.dataset.name !== targetId) button.classList.remove('selected');
    });

    // Toggle the clicked one.
    targetDiv.classList.toggle('open');
    button.classList.toggle('selected');
  });
});