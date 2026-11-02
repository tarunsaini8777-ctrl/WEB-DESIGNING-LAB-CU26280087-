# Lab Sheet 5 - Question 15: Write a Python script utilizing SQLAlchemy ORM to map Python classes to MySQL database tables.

# pip install sqlalchemy pymysql
from sqlalchemy import create_engine, Column, Integer, String
from sqlalchemy.orm import declarative_base, sessionmaker

engine = create_engine("mysql+pymysql://root:@localhost/python_web_db", echo=False)
Base = declarative_base()

class User(Base):
    __tablename__ = "users"
    id = Column(Integer, primary_key=True, autoincrement=True)
    name = Column(String(100), nullable=False)
    email = Column(String(100), unique=True, nullable=False)
    age = Column(Integer)

    def __repr__(self):
        return f"<User(id={self.id}, name={self.name}, email={self.email})>"

Base.metadata.create_all(engine)        # creates table if it does not exist
Session = sessionmaker(bind=engine)
session = Session()

# Create
session.add(User(name="Karan Mehta", email="karan@example.com", age=24))
session.commit()

# Read
for u in session.query(User).filter(User.age >= 18).all():
    print(u)

# Update
user = session.query(User).filter_by(email="karan@example.com").first()
if user:
    user.age = 25
    session.commit()

# Delete
# session.delete(user); session.commit()

session.close()
