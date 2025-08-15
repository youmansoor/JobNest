from fpdf import FPDF
import os

# Create a folder for resumes
resume_dir = "resumes"
os.makedirs(resume_dir, exist_ok=True)

# List of applicants with file names
applicants = [
    ("Ali Raza", "ali_raza_cv.pdf"),
    ("Sara Khan", "sara_khan_resume.pdf"),
    ("Ahmed Hassan", "ahmed_hassan_cv.pdf"),
    ("Fatima Noor", "fatima_noor_resume.pdf"),
    ("Bilal Ahmed", "bilal_ahmed_cv.pdf"),
    ("Ayesha Malik", "ayesha_malik_resume.pdf"),
    ("Zain Siddiqui", "zain_siddiqui_cv.pdf"),
    ("Mariam Yousaf", "mariam_yousaf_resume.pdf"),
    ("Usman Tariq", "usman_tariq_cv.pdf"),
    ("Hina Javed", "hina_javed_resume.pdf")
]

# Generate resumes
for name, filename in applicants:
    pdf = FPDF()
    pdf.add_page()
    pdf.set_font("Arial", "B", 16)
    pdf.cell(0, 10, f"Resume - {name}", ln=True)
    pdf.set_font("Arial", "", 12)
    pdf.cell(0, 10, f"Name: {name}", ln=True)
    pdf.cell(0, 10, "Email: example@example.com", ln=True)
    pdf.cell(0, 10, "Phone: +92-300-0000000", ln=True)
    pdf.multi_cell(0, 10, "Objective:\nTo obtain a challenging position in a reputable organization where I can utilize my skills and experience.")
    
    file_path = os.path.join(resume_dir, filename)
    pdf.output(file_path)
