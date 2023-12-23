### **Key Relationships:**

- **Parent Profiles to Listings and Reviews**: Parents may browse multiple listings and leave reviews for various providers.
- **Provider Profiles to Listings**: Providers create listings to advertise their services. One provider may have multiple listings (e.g., different service types or locations).
- **Listings to Reviews**: Each listing can receive multiple reviews from different parents.
- **User Profiles to User Interactions**: Both Parents and Providers can have multiple interactions, such as inquiries about services or form submissions.

**1. User Profiles**

**1.1 Parent Profiles**

**1.2 Provider Profiles**

- **Relationship**: One-to-Many with Listings, Reviews, and User Interactions.
- **Description**: Each Parent and Provider Profile can be associated with multiple Listings, Reviews, and User Interactions. However, each Listing, Review, or Interaction is associated with only one Parent or Provider Profile.

**2. Listings**

- **Relationship**: Many-to-One with Provider Profiles; One-to-Many with Reviews and User Interactions.
- **Description**: Each Listing is associated with one Provider Profile. Listings can have multiple Reviews and be the subject of multiple User Interactions.

**3. Reviews**

- **Relationship**: Many-to-One with User Profiles and Listings.
- **Description**: Each Review is associated with one User Profile (either Parent or Provider) and one Listing. A User Profile and a Listing can have multiple Reviews.

**4. User Interactions/Inquiries/Form Submissions**

- **Relationship**: Many-to-One with User Profiles and Listings.
- **Description**: Each User Interaction (like inquiries or form submissions) is associated with one User Profile (Parent or Provider) and can be related to a Listing. A User Profile and a Listing can be associated with multiple User Interactions.