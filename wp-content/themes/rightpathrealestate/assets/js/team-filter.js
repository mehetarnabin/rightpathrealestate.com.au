document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.getElementById('agentFilter');
    const agents = document.querySelectorAll('.agent-card');

    dropdown.addEventListener('change', function() {
        const selectedCity = this.value;
        agents.forEach(agent => {
            if (selectedCity === 'all' || agent.dataset.city === selectedCity) {
                agent.style.display = 'block';
            } else {
                agent.style.display = 'none';
            }
        });
    });
});
