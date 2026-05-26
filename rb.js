 document.addEventListener('DOMContentLoaded', function() {
    // Initialize counters for dynamic fields
    let experienceCount = 1;
    let educationCount = 1;
    let skillCount = 1;
    let projectCount = 1;
    
    // Add experience field
    document.getElementById('add-experience').addEventListener('click', function() {
        experienceCount++;
        const newExperience = document.createElement('div');
        newExperience.className = 'experience-form';
        newExperience.innerHTML = `
            <button class="remove-btn remove-experience" data-id="${experienceCount}">Remove</button>
            <div class="form-group">
                <label for="jobTitle${experienceCount}">Job Title</label>
                <input type="text" id="jobTitle${experienceCount}" placeholder="Software Developer">
            </div>
            <div class="form-group">
                <label for="company${experienceCount}">Company</label>
                <input type="text" id="company${experienceCount}" placeholder="Tech Inc.">
            </div>
            <div class="form-group">
                <label for="jobStartDate${experienceCount}">Start Date</label>
                <input type="text" id="jobStartDate${experienceCount}" placeholder="June 2020">
            </div>
            <div class="form-group">
                <label for="jobEndDate${experienceCount}">End Date</label>
                <input type="text" id="jobEndDate${experienceCount}" placeholder="Present">
            </div>
            <div class="form-group">
                <label for="jobDescription${experienceCount}">Description</label>
                <textarea id="jobDescription${experienceCount}" placeholder="Responsibilities and achievements..."></textarea>
            </div>
        `;
        document.getElementById('experience-container').appendChild(newExperience);
    });
    
    // Add education field
    document.getElementById('add-education').addEventListener('click', function() {
        educationCount++;
        const newEducation = document.createElement('div');
        newEducation.className = 'education-form';
        newEducation.innerHTML = `
            <button class="remove-btn remove-education" data-id="${educationCount}">Remove</button>
            <div class="form-group">
                <label for="degree${educationCount}">Degree</label>
                <input type="text" id="degree${educationCount}" placeholder="Bachelor of Science in Computer Science">
            </div>
            <div class="form-group">
                <label for="school${educationCount}">School</label>
                <input type="text" id="school${educationCount}" placeholder="University of Technology">
            </div>
            <div class="form-group">
                <label for="educationStartDate${educationCount}">Start Date</label>
                <input type="text" id="educationStartDate${educationCount}" placeholder="September 2016">
            </div>
            <div class="form-group">
                <label for="educationEndDate${educationCount}">End Date</label>
                <input type="text" id="educationEndDate${educationCount}" placeholder="May 2020">
            </div>
        `;
        document.getElementById('education-container').appendChild(newEducation);
    });
    
    // Add skill field
    document.getElementById('add-skill').addEventListener('click', function() {
        skillCount++;
        const newSkill = document.createElement('div');
        newSkill.className = 'form-group';
        newSkill.innerHTML = `
            <div style="display: flex; gap: 10px;">
                <input type="text" id="skill${skillCount}" placeholder="JavaScript">
                <button class="remove-btn remove-skill" data-id="${skillCount}">Remove</button>
            </div>
        `;
        document.getElementById('skills-container').appendChild(newSkill);
    });
    
    // Add project field
    document.getElementById('add-project').addEventListener('click', function() {
        projectCount++;
        const newProject = document.createElement('div');
        newProject.className = 'project-form';
        newProject.innerHTML = `
            <button class="remove-btn remove-project" data-id="${projectCount}">Remove</button>
            <div class="form-group">
                <label for="projectName${projectCount}">Project Name</label>
                <input type="text" id="projectName${projectCount}" placeholder="E-commerce Website">
            </div>
            <div class="form-group">
                <label for="projectDescription${projectCount}">Description</label>
                <textarea id="projectDescription${projectCount}" placeholder="Details about the project..."></textarea>
            </div>
        `;
        document.getElementById('projects-container').appendChild(newProject);
    });
    
    // Remove fields dynamically
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-experience')) {
            const id = e.target.getAttribute('data-id');
            const experienceToRemove = e.target.parentElement;
            experienceToRemove.remove();
        }
        
        if (e.target.classList.contains('remove-education')) {
            const id = e.target.getAttribute('data-id');
            const educationToRemove = e.target.parentElement;
            educationToRemove.remove();
        }
        
        if (e.target.classList.contains('remove-skill')) {
            const id = e.target.getAttribute('data-id');
            const skillToRemove = e.target.parentElement.parentElement;
            skillToRemove.remove();
        }
        
        if (e.target.classList.contains('remove-project')) {
            const id = e.target.getAttribute('data-id');
            const projectToRemove = e.target.parentElement;
            projectToRemove.remove();
        }
    });
    
    // Update preview on any input change
    document.querySelectorAll('input, textarea').forEach(element => {
        element.addEventListener('input', updateResumePreview);
    });
    
    // Initial preview update
    updateResumePreview();
    
    // Download PDF
    document.getElementById('download-pdf').addEventListener('click', function() {
        const element = document.getElementById('resume-preview');
        const opt = {
            margin: 10,
            filename: 'resume.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };
        
        // Make sure html2pdf is available
        if (typeof html2pdf !== 'undefined') {
            html2pdf().from(element).set(opt).save();
        } else {
            alert('PDF generation library not loaded. Please try again.');
        }
    });
    
    // Function to update resume preview
    function updateResumePreview() {
        const resumePreview = document.getElementById('resume-preview');
        
        // Personal Information
        const fullName = document.getElementById('fullName').value || 'Your Name';
        const email = document.getElementById('email').value || 'your.email@example.com';
        const phone = document.getElementById('phone').value || '(123) 456-7890';
        const address = document.getElementById('address').value || 'City, Country';
        const linkedin = document.getElementById('linkedin').value;
        const github = document.getElementById('github').value;
        
        // Professional Summary
        const summary = document.getElementById('summary').value || 'Experienced professional with skills in...';
        
        // Work Experience
        let experiencesHTML = '';
        for (let i = 1; i <= experienceCount; i++) {
            if (!document.getElementById(`jobTitle${i}`)) continue;
            
            const jobTitle = document.getElementById(`jobTitle${i}`).value || 'Job Title';
            const company = document.getElementById(`company${i}`).value || 'Company Name';
            const jobStartDate = document.getElementById(`jobStartDate${i}`).value || 'Start Date';
            const jobEndDate = document.getElementById(`jobEndDate${i}`).value || 'End Date';
            const jobDescription = document.getElementById(`jobDescription${i}`).value || 'Responsibilities and achievements...';
            
            experiencesHTML += `
                <div class="experience-item">
                    <div class="job-title">${jobTitle}</div>
                    <div class="company">${company}</div>
                    <div class="date">${jobStartDate} - ${jobEndDate}</div>
                    <div class="job-description">${jobDescription}</div>
                </div>
            `;
        }
        
        // Education
        let educationHTML = '';
        for (let i = 1; i <= educationCount; i++) {
            if (!document.getElementById(`degree${i}`)) continue;
            
            const degree = document.getElementById(`degree${i}`).value || 'Degree';
            const school = document.getElementById(`school${i}`).value || 'School Name';
            const educationStartDate = document.getElementById(`educationStartDate${i}`).value || 'Start Date';
            const educationEndDate = document.getElementById(`educationEndDate${i}`).value || 'End Date';
            
            educationHTML += `
                <div class="education-item">
                    <div class="degree">${degree}</div>
                    <div class="school">${school}</div>
                    <div class="date">${educationStartDate} - ${educationEndDate}</div>
                </div>
            `;
        }
        
        // Skills
        let skillsHTML = '';
        for (let i = 1; i <= skillCount; i++) {
            if (!document.getElementById(`skill${i}`)) continue;
            
            const skill = document.getElementById(`skill${i}`).value;
            if (skill) {
                skillsHTML += `<span class="skill">${skill}</span>`;
            }
        }
        
        // Projects
        let projectsHTML = '';
        for (let i = 1; i <= projectCount; i++) {
            if (!document.getElementById(`projectName${i}`)) continue;
            
            const projectName = document.getElementById(`projectName${i}`).value || 'Project Name';
            const projectDescription = document.getElementById(`projectDescription${i}`).value || 'Project description...';
            
            projectsHTML += `
                <div class="project-item">
                    <div class="project-name"><strong>${projectName}</strong></div>
                    <div class="project-description">${projectDescription}</div>
                </div>
            `;
        }
        
        // Social Links
        let socialLinksHTML = '';
        if (linkedin) {
            socialLinksHTML += `<a href="${linkedin}" target="_blank">LinkedIn</a> | `;
        }
        if (github) {
            socialLinksHTML += `<a href="${github}" target="_blank">GitHub</a>`;
        }
        
        // Build the resume preview
        resumePreview.innerHTML = `
            <div class="resume-header">
                <h2>${fullName}</h2>
                <p>${address} | ${phone} | ${email}</p>
                ${socialLinksHTML ? `<p>${socialLinksHTML}</p>` : ''}
            </div>
            
            <div class="resume-section">
                <h3>Professional Summary</h3>
                <p>${summary}</p>
            </div>
            
            ${experiencesHTML ? `
            <div class="resume-section">
                <h3>Work Experience</h3>
                ${experiencesHTML}
            </div>
            ` : ''}
            
            ${educationHTML ? `
            <div class="resume-section">
                <h3>Education</h3>
                ${educationHTML}
            </div>
            ` : ''}
            
            ${skillsHTML ? `
            <div class="resume-section">
                <h3>Skills</h3>
                <div class="skills-list">
                    ${skillsHTML}
                </div>
            </div>
            ` : ''}
            
            ${projectsHTML ? `
            <div class="resume-section">
                <h3>Projects</h3>
                ${projectsHTML}
            </div>
            ` : ''}
        `;
    }
});